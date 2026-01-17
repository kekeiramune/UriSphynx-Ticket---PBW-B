<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking User ID 3 Transactions ===\n\n";

// Direct query
$transactions = App\Models\Transaction::where('user_id', 3)->get();
echo "Transactions for user_id 3: " . $transactions->count() . "\n\n";

if ($transactions->count() > 0) {
    foreach ($transactions as $trans) {
        echo "Transaction ID: {$trans->id_transaction}\n";
        echo "Concert ID: {$trans->id_concert}\n";
        echo "Status: {$trans->status}\n";
        echo "---\n";
    }
} else {
    echo "No transactions found!\n\n";
    echo "Let's check all transactions:\n";
    $all = App\Models\Transaction::all();
    foreach ($all as $t) {
        echo "ID: {$t->id_transaction} | user_id: {$t->user_id} | Concert: {$t->id_concert}\n";
    }
}
