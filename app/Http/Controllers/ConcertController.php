<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Concert;
use App\Models\Seating;
use App\Models\Category;

class ConcertController extends Controller {
    public function show($id_concert)
{
    $concert = Concert::findOrFail($id_concert);
    $seats = Seating::all();

    return view('concert-page', compact('concert', 'seats'));
}
}