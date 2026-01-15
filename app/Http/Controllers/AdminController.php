<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Concert_Price;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $concerts = DB::table('concerts')
            ->join('concert_prices', 'concerts.id', '=', 'concert_prices.concert_id')
            ->select(
                'concerts.id',
                'concerts.name',
                'concerts.date',
                'concerts.venue',
                'concert_prices.price',
                'concert_prices.category'
            )
            ->get();

        return view('admin.ticketmanage', compact('concerts'));
    }
    public function dashboardadmin()
    {
        abort_unless(Gate::allows('admin'), 403);

        // Calculate total revenue from paid transactions
        $totalRevenue = Transaction::where('status', 'Paid')->sum('total_price');

        // Get daily sales for last 12 days (current period)
        $currentPeriodStart = now()->subDays(11)->startOfDay();
        $currentPeriodEnd = now()->endOfDay();

        $dailySalesLast12Days = Transaction::where('status', 'Paid')
            ->whereBetween('created_at', [$currentPeriodStart, $currentPeriodEnd])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        // Get daily sales for previous 12 days (comparison period)
        $previousPeriodStart = now()->subDays(23)->startOfDay();
        $previousPeriodEnd = now()->subDays(12)->endOfDay();

        $dailySalesPrevious12Days = Transaction::where('status', 'Paid')
            ->whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        // Fill in missing dates with 0 for current period
        $currentPeriodData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $currentPeriodData[] = $dailySalesLast12Days->get($date, 0);
        }

        // Fill in missing dates with 0 for previous period
        $previousPeriodData = [];
        for ($i = 23; $i >= 12; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $previousPeriodData[] = $dailySalesPrevious12Days->get($date, 0);
        }

        // Calculate revenue growth percentage
        $currentTotal = array_sum($currentPeriodData);
        $previousTotal = array_sum($previousPeriodData);
        $revenueGrowth = $previousTotal > 0
            ? round((($currentTotal - $previousTotal) / $previousTotal) * 100, 1)
            : 0;

        // Analyze order time distribution
        $transactions = Transaction::where('status', 'Paid')->get();

        $morningCount = 0;
        $afternoonCount = 0;
        $eveningCount = 0;

        foreach ($transactions as $transaction) {
            $hour = (int) $transaction->created_at->format('H');

            if ($hour >= 0 && $hour < 12) {
                $morningCount++;
            } elseif ($hour >= 12 && $hour < 18) {
                $afternoonCount++;
            } else {
                $eveningCount++;
            }
        }

        $totalTransactions = $transactions->count();
        $orderTimeData = [
            'afternoon' => $totalTransactions > 0 ? round(($afternoonCount / $totalTransactions) * 100) : 0,
            'evening' => $totalTransactions > 0 ? round(($eveningCount / $totalTransactions) * 100) : 0,
            'morning' => $totalTransactions > 0 ? round(($morningCount / $totalTransactions) * 100) : 0,
        ];

        // Get top 4 concerts by ticket sales
        $topConcerts = DB::table('concert_price')
            ->join('concerts', 'concert_price.id_concert', '=', 'concerts.id_concert')
            ->select(
                'concerts.concert_name',
                'concert_price.ticket_price',
                DB::raw('SUM(concert_price.sold) as total_sold')
            )
            ->groupBy('concerts.id_concert', 'concerts.concert_name', 'concert_price.ticket_price')
            ->orderBy('total_sold', 'desc')
            ->limit(4)
            ->get();

        return view('admin.dashboardadmin', compact(
            'totalRevenue',
            'revenueGrowth',
            'currentPeriodData',
            'previousPeriodData',
            'orderTimeData',
            'topConcerts'
        ));
    }

    // Concert Management CRUD
    public function concertmanage()
    {
        abort_unless(Gate::allows('admin'), 403);

        $concerts = DB::table('concerts')
            ->leftJoin('category', 'concerts.category_id', '=', 'category.idgroup')
            ->select(
                'concerts.*',
                'category.groupname as category_name'
            )
            ->orderBy('concerts.concert_date', 'desc')
            ->get();

        return view('admin.concertmanage', compact('concerts'));
    }

    public function createConcert()
    {
        abort_unless(Gate::allows('admin'), 403);

        $categories = DB::table('category')->get();
        return view('admin.concert_create', compact('categories'));
    }

    public function storeConcert(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403);

        $request->validate([
            'concert_name' => 'required|string|max:255',
            'concert_date' => 'required|date',
            'concert_time' => 'required',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status_concert' => 'required|in:Upcoming,Ongoing,Finished,Cancelled',
            'category_id' => 'required|exists:category,idgroup',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('concerts', 'public');

        // Combine date and time for datetime column
        $concertDateTime = $request->concert_date . ' ' . $request->concert_time . ':00';

        DB::table('concerts')->insert([
            'concert_name' => $request->concert_name,
            'concert_date' => $request->concert_date,
            'concert_time' => $concertDateTime,
            'venue' => $request->venue,
            'city' => $request->city,
            'status_concert' => $request->status_concert,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.concertmanage')
            ->with('success', 'Concert created successfully');
    }

    public function editConcert($id)
    {
        abort_unless(Gate::allows('admin'), 403);

        $concert = DB::table('concerts')->where('id_concert', $id)->first();
        $categories = DB::table('category')->get();

        if (!$concert) {
            return redirect()->route('admin.concertmanage')->with('error', 'Concert not found');
        }

        return view('admin.concert_edit', compact('concert', 'categories'));
    }

    public function updateConcert(Request $request, $id)
    {
        abort_unless(Gate::allows('admin'), 403);

        $request->validate([
            'concert_name' => 'required|string|max:255',
            'concert_date' => 'required|date',
            'concert_time' => 'required',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status_concert' => 'required|in:Upcoming,Ongoing,Finished,Cancelled',
            'category_id' => 'required|exists:category,idgroup',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $concert = DB::table('concerts')->where('id_concert', $id)->first();

        // Combine date and time for datetime column
        $concertDateTime = $request->concert_date . ' ' . $request->concert_time . ':00';

        $data = [
            'concert_name' => $request->concert_name,
            'concert_date' => $request->concert_date,
            'concert_time' => $concertDateTime,
            'venue' => $request->venue,
            'city' => $request->city,
            'status_concert' => $request->status_concert,
            'category_id' => $request->category_id,
        ];

        // Handle image upload if new image provided
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('concerts', 'public');
        }

        DB::table('concerts')->where('id_concert', $id)->update($data);

        return redirect()
            ->route('admin.concertmanage')
            ->with('success', 'Concert updated successfully');
    }

    public function deleteConcert($id)
    {
        abort_unless(Gate::allows('admin'), 403);

        // Check if concert has tickets
        $hasTickets = DB::table('concert_price')->where('id_concert', $id)->exists();

        if ($hasTickets) {
            return redirect()
                ->route('admin.concertmanage')
                ->with('error', 'Cannot delete concert with existing tickets. Please delete tickets first.');
        }

        DB::table('concerts')->where('id_concert', $id)->delete();

        return redirect()
            ->route('admin.concertmanage')
            ->with('success', 'Concert deleted successfully');
    }

    // Old ticket creation methods (keeping for backward compatibility)
    public function createTicket()
    {
        return view('admin.concertmanage_create');
    }

    public function storeTicket(Request $request)
    {
        DB::transaction(function () use ($request) {

            // insert ke concerts
            $concertId = DB::table('concerts')->insertGetId([
                'concert_name' => $request->concertname,
                'concert_date' => now(),
                'venue' => 'TBA',
                'status_concert' => 'Upcoming',
            ]);

            // insert ke concert_price
            DB::table('concert_price')->insert([
                'id_concert' => $concertId,
                'id_seating' => 1, // sementara, nanti bisa dari dropdown
                'ticket_price' => $request->concertprice,
                'quota' => $request->concertquota,
                'sold' => 0,
                'status_seating' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect()
            ->route('admin.ticketmanage')
            ->with('success', 'Ticket berhasil ditambahkan');
    }


    public function ticketManage()
    {
        $concerts = DB::table('concerts')
            ->join('concert_price', 'concerts.id_concert', '=', 'concert_price.id_concert')
            ->join('seating', 'concert_price.id_seating', '=', 'seating.id_seating')
            ->select(
                'concerts.concert_name',
                'concerts.concert_date',
                'concerts.venue',
                'seating.name_seating',
                'concert_price.ticket_price',
                'concert_price.quota',
                'concert_price.sold',
                'concert_price.status_seating',
                'concert_price.id_price'

            )
            ->get();

        return view('admin.ticketmanage', compact('concerts'));
    }

    public function editTicket($id)
    {
        $ticket = DB::table('concert_price')
            ->join('concerts', 'concert_price.id_concert', '=', 'concerts.id_concert')
            ->join('seating', 'concert_price.id_seating', '=', 'seating.id_seating')
            ->where('concert_price.id_price', $id)
            ->select(
                'concert_price.id_price',
                'concert_price.ticket_price',
                'concert_price.quota',
                'concert_price.status_seating',
                'concerts.concert_name',
                'seating.name_seating'
            )
            ->first();

        return view('admin.ticket_edit', compact('ticket'));
    }

    public function updateTicket(Request $request, $id)
    {
        DB::table('concert_price')
            ->where('id_price', $id)
            ->update([
                'ticket_price' => $request->ticket_price,
                'quota' => $request->quota,
                'status_seating' => $request->status_seating,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.ticketmanage')
            ->with('success', 'Ticket updated successfully');
    }

    // Create Ticket Price (for existing concerts)
    public function createTicketPrice()
    {
        abort_unless(Gate::allows('admin'), 403);

        $concerts = DB::table('concerts')
            ->select('id_concert', 'concert_name', 'concert_date', 'venue')
            ->orderBy('concert_name')
            ->get();

        $seatings = DB::table('seating')
            ->select('id_seating', 'name_seating')
            ->get();

        return view('admin.ticket_create', compact('concerts', 'seatings'));
    }

    public function storeTicketPrice(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403);

        $request->validate([
            'id_concert' => 'required|exists:concerts,id_concert',
            'id_seating' => 'required|exists:seating,id_seating',
            'ticket_price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'status_seating' => 'required|in:available,sold_out,hidden',
        ]);

        DB::table('concert_price')->insert([
            'id_concert' => $request->id_concert,
            'id_seating' => $request->id_seating,
            'ticket_price' => $request->ticket_price,
            'quota' => $request->quota,
            'sold' => 0,
            'status_seating' => $request->status_seating,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.ticketmanage')
            ->with('success', 'Ticket price added successfully');
    }

    public function deleteTicket($id)
    {
        abort_unless(Gate::allows('admin'), 403);

        // Check if any tickets have been sold
        $ticket = DB::table('concert_price')->where('id_price', $id)->first();

        if ($ticket && $ticket->sold > 0) {
            return redirect()
                ->route('admin.ticketmanage')
                ->with('error', 'Cannot delete ticket with sold items. Please set status to hidden instead.');
        }

        DB::table('concert_price')->where('id_price', $id)->delete();

        return redirect()
            ->route('admin.ticketmanage')
            ->with('success', 'Ticket deleted successfully');
    }



    public function accountmanage()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.accountmanage');
    }

    public function editprofadmin()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.editprofadmin');
    }

    public function categoryview()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.categorymanage');
    }

    public function showCategory()
    {
        abort_unless(Gate::allows('admin'), 403);

        $categories = DB::table('category')->get();
        return view('admin.categorymanage', compact('categories'));
    }

    public function createCategory()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.category_create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'groupname' => 'required|string|max:100',
            'type' => 'required|in:Boygroup,Girlgroup,Co-ed group,Band,Soloist',
            'debut' => 'required|string',
            'agency' => 'required|in:HYBE,JYP,SM,YG',
            'popular' => 'required|in:mostp,trend,new',
            'groupimg' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $request->file('groupimg')->store('categories', 'public');

        DB::table('category')->insert([
            'groupname' => $request->groupname,
            'type' => $request->type,
            'debut' => $request->debut,
            'agency' => $request->agency,
            'popular' => $request->popular,
            'groupimg' => $path,
        ]);

        return redirect()
            ->route('admin.categorymanage')
            ->with('success', 'Category berhasil ditambahkan');
    }

    public function editCategory($id)
    {
        abort_unless(Gate::allows('admin'), 403);

        $category = DB::table('category')
            ->where('idgroup', $id)
            ->first();

        return view('admin.category_edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {

        $request->validate([
            'groupname' => 'required|string|max:100',
            'type' => 'required|in:Boygroup,Girlgroup,Co-ed group,Band,Soloist',
            'debut' => 'required|string',
            'agency' => 'required|in:HYBE,JYP,SM,YG',
            'popular' => 'required|in:mostp,trend,new',
            'groupimg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = DB::table('category')->where('idgroup', $id)->first();

        $data = [
            'groupname' => $request->groupname,
            'type' => $request->type,
            'debut' => $request->debut,
            'agency' => $request->agency,
            'popular' => $request->popular,
        ];

        if ($request->hasFile('groupimg')) {
            $data['groupimg'] = $request->file('groupimg')->store('categories', 'public');
        } else {
            // pakai gambar lama
            $data['groupimg'] = $category->groupimg;
        }

        $affected = DB::table('category')
            ->where('idgroup', $id)
            ->update($data);

        if ($affected === 0) {
            return back()->with('info', 'Tidak ada perubahan data');
        }



        DB::table('category')->where('idgroup', $id)->update($data);

        return redirect()->route('admin.categorymanage')
            ->with('success', 'Category berhasil diupdate');
    }


    public function deleteCategory($id)
    {
        DB::table('category')
            ->where('idgroup', $id)
            ->delete();

        return redirect()
            ->route('admin.categorymanage')
            ->with('success', 'Category berhasil dihapus');
    }

    public function transactions()
    {
        abort_unless(Gate::allows('admin'), 403);

        $transactions = Transaction::with(['user', 'concert', 'concertPrice'])
            ->latest()
            ->get();

        return view('admin.transadmin', compact('transactions'));
    }

    public function approveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status === 'Paid') {
            return back()->with('info', 'Transaction already approved');
        }

        // update status
        $transaction->update([
            'status' => 'Paid',
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        // Generate ticket with QR code
        $ticketCode = 'TIX-' . strtoupper(uniqid());

        // Generate QR Code
        $qrCodePath = 'qrcodes/' . $ticketCode . '.png';
        $qrCodeFullPath = storage_path('app/public/' . $qrCodePath);

        // Create directory if not exists
        if (!file_exists(storage_path('app/public/qrcodes'))) {
            mkdir(storage_path('app/public/qrcodes'), 0755, true);
        }

        // Generate QR Code image
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
            ->size(300)
            ->margin(1)
            ->generate($ticketCode, $qrCodeFullPath);

        // Create ticket record
        Ticket::create([
            'transaction_id' => $transaction->id_transaction,
            'user_id' => $transaction->user_id,
            'id_concert' => $transaction->id_concert,
            'id_price' => $transaction->id_price,
            'ticket_code' => $ticketCode,
            'qr_code_path' => $qrCodePath,
            'status' => 'active'
        ]);

        // Update sold ticket count
        $price = Concert_Price::find($transaction->id_price);
        if ($price) {
            $price->increment('sold');
        }

        return back()->with('success', 'Transaction approved successfully! Tickets have been generated.');
    }

    public function rejectTransaction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status === 'Paid') {
            return back()->with('error', 'Cannot reject an already approved transaction');
        }

        // Update transaction with rejection notes
        $transaction->update([
            'status' => 'Pending',
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Transaction rejected. Customer has been notified.');
    }

    public function profile()
    {
        return view('admin.accountmanage', [
            'user' => auth()->user()
        ]);
    }


    public function edit()
    {
        return view('admin.editprofadmin', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('accimage')) {
            $file = $request->file('accimage');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/photo_profile', $filename);

            // simpan ke kolom accimage
            $user->accimage = $filename;
        }

        $user->name = $request->adminname;
        $user->email = $request->adminemail;
        $user->no_hp = $request->adminumber;
        $user->save();

        return redirect()
            ->route('admin.accountmanage')
            ->with('success', 'Profile updated successfully');
    }




}