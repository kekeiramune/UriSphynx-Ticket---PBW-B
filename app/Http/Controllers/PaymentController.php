<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Concert_Price;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Concert $concert)
    {
        $prices = Concert_Price::with('seating')
            ->where('id_concert', $concert->id_concert)
            ->get();

        return view('payment', compact('concert', 'prices'));
    }

    public function store(Request $request, Concert $concert)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_price' => 'required|exists:concert_price,id_price',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $price = Concert_Price::findOrFail($request->id_price);
        // cek quota
        if ($price->sold >= $price->quota) {
            return back()->withErrors('Ticket sold out.');
        }

        // simpan file
        $proofName = time() . '_' . $request->file('payment_proof')->getClientOriginalName();
        $request->file('payment_proof')->storeAs('payment_proofs', $proofName, 'public');


        // simpan transaksi
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'id_concert' => $concert->id_concert,
            'id_price' => $price->id_price,
            'name' => $request->name,
            'payment_method' => $request->payment_method,
            'total_price' => $price->ticket_price,
            'status' => 'pending', // sementara langsung paid
            'payment_proof' => $proofName,
        ]);



        // update jumlah sold
        $price->increment('sold');

        return redirect()
            ->route('dashboard')
            ->with('success', 'Payment successful!');
    }
}