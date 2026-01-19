<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Concert;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard with active tickets and purchase history.
     */
    public function index()
    {
        $user = Auth::user();

        try {
            // Get active tickets for the user
            $activeTickets = Ticket::with(['concert.category', 'concertPrice.seating'])
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->whereHas('concert', function($query) {
                    $query->where('concert_time', '>', now());
                })
                ->get()
                ->sortBy(function($ticket) {
                    return $ticket->concert->concert_time;
                });

            // Get purchase history (all transactions)
            $purchaseHistory = Transaction::with(['concert', 'concertPrice.seating'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            // If tables don't exist yet (migrations not run), return empty collections
            $activeTickets = collect([]);
            $purchaseHistory = collect([]);
        }

        return view('dashboard', compact('activeTickets', 'purchaseHistory'));
    }

    /**
     * Get active tickets for the authenticated user.
     */
    public function getActiveTickets()
    {
        $user = Auth::user();

        $tickets = Ticket::with(['concert', 'seating'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->get();

        return response()->json($tickets);
    }

    /**
     * Get purchase history for the authenticated user.
     */
    public function getPurchaseHistory()
    {
        $user = Auth::user();

        $transactions = Transaction::with(['concert', 'seating'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions);
    }

    /**
     * Show detailed e-ticket information.
     */
    public function showTicket($id)
    {
        $user = Auth::user();

        $ticket = Ticket::with(['concert', 'seating', 'transaction'])
            ->where('id_ticket', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('ticket-detail', compact('ticket'));
    }
}
