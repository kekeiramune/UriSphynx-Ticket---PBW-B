<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Concert_Price;
use App\Models\Concert;
use App\Models\Seating;
use App\Models\Category;

class Concert_PriceController extends Controller {
    public function show($id_price)
{
    $concert_price = Concert_Price::findOrFail($id_price);
    $seats = Seating::all();

    return view('concert-page', compact('concert_price', 'seats'));
}
public function seating()
{
    return $this->belongsTo(Seating::class, 'id_seating');
}
}