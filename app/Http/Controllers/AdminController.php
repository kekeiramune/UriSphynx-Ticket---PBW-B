<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Concert_Price;
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

        return view('admin.dashboardadmin');
    }

    public function concertmanage()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.concertmanage');
    }

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

        $transactions = Transaction::with(['user', 'concert', 'price'])
            ->latest()
            ->get();

        return view('admin.transadmin', compact('transactions'));
    }

    public function approveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status === 'paid') {
            return back();
        }

        // update status
        $transaction->update([
            'status' => 'paid'
        ]);

        // update sold ticket
        $price = Concert_Price::find($transaction->id_price);
        if ($price) {
            $price->increment('sold');
        }

        return back()->with('success', 'Transaction approved');
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