<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTicketController extends Controller
{
    public function create()
    {
        return view('admin.manageconcert');
    }

    public function store(Request $request)
    {
        DB::table('concert_prices')->insert([
            'concert_id'   => $request->concert_id,
            'name_seating' => $request->category,
            'ticket_price' => $request->price,
            'quota'        => $request->quota,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()
            ->route('admin.ticketmanage')
            ->with('success', 'Ticket berhasil ditambahkan');
    }
}

