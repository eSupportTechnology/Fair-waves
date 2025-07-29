<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\DealerProductLink;
use App\Models\User;

$product = Product::first();
$dealer = User::where('role', 'dealer')->first();

if (!$product || !$dealer) {
    echo "Missing data - Product or Dealer not found" . PHP_EOL;
    exit;
}

$link = DealerProductLink::where('dealer_id', $dealer->id)
    ->where('product_id', $product->id)
    ->first();

echo "Product ID: " . $product->id . PHP_EOL;
echo "Product product_id field: " . $product->product_id . PHP_EOL; 
echo "Dealer ID: " . $dealer->id . PHP_EOL;
echo "Link exists: " . ($link ? 'Yes - ID: ' . $link->id : 'No') . PHP_EOL;

// Test what happens in addToCart logic
echo "=== Testing addToCart logic ===" . PHP_EOL;
$dealerProductLink = DealerProductLink::where('dealer_id', $dealer->id)
    ->where('product_id', $product->id)
    ->first();

if ($dealerProductLink) {
    echo "SUCCESS: DealerProductLink found with ID: " . $dealerProductLink->id . PHP_EOL;
} else {
    echo "ERROR: DealerProductLink not found" . PHP_EOL;
}
