<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Transaction Relationships ===\n\n";

// Test without relationships
$trans1 = App\Models\Transaction::where('user_id', 3)->get();
echo "Without relationships: " . $trans1->count() . " transactions\n\n";

// Test with concert relationship
try {
    $trans2 = App\Models\Transaction::with(['concert'])->where('user_id', 3)->get();
    echo "With concert relationship: " . $trans2->count() . " transactions\n";
    if ($trans2->count() > 0) {
        $first = $trans2->first();
        echo "First transaction concert: " . ($first->concert ? $first->concert->concert_name : 'NULL') . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR with concert: " . $e->getMessage() . "\n";
}

echo "\n";

// Test with price.seating relationship
try {
    $trans3 = App\Models\Transaction::with(['price.seating'])->where('user_id', 3)->get();
    echo "With price.seating relationship: " . $trans3->count() . " transactions\n";
    if ($trans3->count() > 0) {
        $first = $trans3->first();
        echo "First transaction price: " . ($first->price ? 'EXISTS' : 'NULL') . "\n";
        if ($first->price) {
            echo "First transaction seating: " . ($first->price->seating ? $first->price->seating->name_seating : 'NULL') . "\n";
        }
    }
} catch (\Exception $e) {
    echo "ERROR with price.seating: " . $e->getMessage() . "\n";
}

echo "\n";

// Test with all relationships (like in controller)
try {
    $trans4 = App\Models\Transaction::with(['concert', 'price.seating'])
        ->where('user_id', 3)
        ->orderBy('created_at', 'desc')
        ->get();
    echo "With all relationships (like controller): " . $trans4->count() . " transactions\n";
} catch (\Exception $e) {
    echo "ERROR with all relationships: " . $e->getMessage() . "\n";
}
