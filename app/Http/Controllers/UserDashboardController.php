<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard with transaction history and active tickets
     */
    public function index()
    {
        $user = Auth::user();
        
        // DEBUG: Log current user info
        \Log::info('Dashboard accessed by user', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role
        ]);
        
        // Redirect admin users to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboardadmin');
        }
        
        // Get all transactions for the user with related data
        $transactions = Transaction::with(['concert', 'price.seating'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // DEBUG: Log transaction query results
        \Log::info('Transactions query result', [
            'user_id' => $user->id,
            'transaction_count' => $transactions->count(),
            'all_transactions_count' => Transaction::count()
        ]);
        
        // Get active tickets (paid transactions for upcoming/ongoing concerts)
        $activeTickets = Transaction::with(['concert.category', 'price.seating'])
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereHas('concert', function($query) {
                $query->whereIn('status_concert', ['Upcoming', 'Ongoing']);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        // DEBUG: Log active tickets
        \Log::info('Active tickets result', [
            'active_tickets_count' => $activeTickets->count()
        ]);
        
        return view('dashboard', compact('transactions', 'activeTickets'));
    }
    
    /**
     * Show transaction detail
     */
    public function showTransaction($id)
    {
        $transaction = Transaction::with(['concert', 'price.seating'])
            ->where('user_id', Auth::id())
            ->where('id_transaction', $id)
            ->firstOrFail();
        
        return view('user.transaction-detail', compact('transaction'));
    }
    
    /**
     * Show ticket detail (e-ticket view)
     */
    public function showTicket($id)
    {
        $transaction = Transaction::with(['concert.category', 'price.seating', 'user'])
            ->where('user_id', Auth::id())
            ->where('id_transaction', $id)
            ->where('status', 'paid')
            ->firstOrFail();
        
        return view('user.ticket-detail', compact('transaction'));
    }
}
