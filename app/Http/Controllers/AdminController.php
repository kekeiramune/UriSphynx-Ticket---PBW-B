<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    public function transactions()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.transadmin');
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

}