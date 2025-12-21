<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Concert;
use App\Models\Seating;
use App\Models\Category;
use App\Models\Concert_Price;

class ConcertController extends Controller {
    public function show($id_concert)
{
    $concerts = Concert::with('prices.seating')->findOrFail($id_concert);

    return view('concert-page', compact('concerts'));
}
}