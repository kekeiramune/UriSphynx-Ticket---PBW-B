<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\Concert_Price;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

echo "=== Regenerating Missing QR Codes ===\n\n";

// Ensure directory exists
if (!file_exists(storage_path('app/public/qrcodes'))) {
    mkdir(storage_path('app/public/qrcodes'), 0755, true);
    echo "Created qrcodes directory.\n";
}

// Get all PAID transactions
$paidTransactions = Transaction::where('status', 'Paid')->get();
echo "Found " . $paidTransactions->count() . " paid transactions.\n";

foreach ($paidTransactions as $transaction) {
    echo "Processing Transaction ID: {$transaction->id_transaction}... ";
    
    // Check if ticket already exists
    $ticket = Ticket::where('transaction_id', $transaction->id_transaction)->first();
    
    if (!$ticket) {
        echo "Missing Ticket! Generating... ";
        
        $ticketCode = 'TIX-' . strtoupper(uniqid());
        $qrCodePath = 'qrcodes/' . $ticketCode . '.svg';
        $qrCodeFullPath = storage_path('app/public/' . $qrCodePath);
        
        try {
            // Generate QR Code image as SVG (doesn't require GD)
            QrCode::format('svg')
                ->size(300)
                ->margin(1)
                ->generate($ticketCode, $qrCodeFullPath);
                
            // Create ticket record
            Ticket::create([
                'transaction_id' => $transaction->id_transaction,
                'user_id' => $transaction->user_id,
                'id_concert' => $transaction->id_concert,
                'id_price' => $transaction->id_price,
                'ticket_code' => $ticketCode,
                'qr_code_path' => $qrCodePath,
                'status' => 'active'
            ]);
            
            echo "DONE (New Code: $ticketCode, SVG format)\n";
        } catch (\Exception $e) {
            echo "FAILED: " . $e->getMessage() . "\n";
        }
        
    } else {
        // Ticket exists, check if file exists
        $fullPath = storage_path('app/public/' . $ticket->qr_code_path);
        if (!file_exists($fullPath)) {
            echo "Ticket Exists but Image Missing! Regenerating... ";
            try {
                QrCode::format('png')
                    ->size(300)
                    ->margin(1)
                    ->generate($ticket->ticket_code, $fullPath);
                echo "DONE.\n";
            } catch (\Exception $e) {
                echo "FAILED: " . $e->getMessage() . "\n";
            }
        } else {
            echo "OK.\n";
        }
    }
}

echo "\nFinished regeneration.\n";
