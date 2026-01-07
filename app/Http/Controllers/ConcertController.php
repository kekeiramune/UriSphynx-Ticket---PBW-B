<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Concert;
use App\Models\Seating;
use App\Models\Category;
use App\Models\Concert_Price;

class ConcertController extends Controller
{
    public function show($id_concert)
    {
        $concerts = Concert::with('category')->findOrFail($id_concert);

        if (\Carbon\Carbon::parse($concerts->concert_time)->isPast() && $concerts->status_concert !== 'Finished') {
            $concerts->status_concert = 'Finished';
            $concerts->save();
        }

        $prices = Concert_Price::with('seating')
            ->where('id_concert', $id_concert)
            ->get();

        return view('concert-page', compact('concerts', 'prices'));
    }
}