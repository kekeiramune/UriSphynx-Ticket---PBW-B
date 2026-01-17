<?php

// Debug script to check transactions
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Transaction Debug ===\n\n";

// Check total transactions
$totalTransactions = App\Models\Transaction::count();
echo "Total transactions in database: $totalTransactions\n\n";

// Get all users
$users = App\Models\User::all();
echo "Users:\n";
foreach ($users as $user) {
    $transCount = App\Models\Transaction::where('user_id', $user->id)->count();
    echo "- {$user->name} (ID: {$user->id}, Role: {$user->role}): $transCount transactions\n";
}

echo "\n=== Recent Transactions ===\n";
$recentTransactions = App\Models\Transaction::with(['concert', 'user'])
    ->latest()
    ->limit(5)
    ->get();

foreach ($recentTransactions as $trans) {
    echo "ID: {$trans->id_transaction} | User: {$trans->user->name} | Concert: {$trans->concert->concert_name} | Status: {$trans->status}\n";
}
