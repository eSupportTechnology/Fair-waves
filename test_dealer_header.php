<?php
require_once 'vendor/autoload.php';

use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->boot();

echo "=== Dealer Header Profile Image Test ===" . PHP_EOL;

// Check if we have any dealers
$dealers = User::where('role', 'dealer')->with('dealerProfile')->get();

if ($dealers->isEmpty()) {
    echo "No dealers found in the database." . PHP_EOL;
    exit;
}

echo "Found " . $dealers->count() . " dealers:" . PHP_EOL;

foreach ($dealers as $dealer) {
    echo PHP_EOL;
    echo "Dealer ID: " . $dealer->id . PHP_EOL;
    echo "Name: " . $dealer->name . PHP_EOL;
    echo "Email: " . $dealer->email . PHP_EOL;
    echo "Profile Image: " . ($dealer->profile_image ?: 'None') . PHP_EOL;
    
    if ($dealer->profile_image) {
        echo "Profile Image URL: " . $dealer->profile_image_url . PHP_EOL;
    }
    
    if ($dealer->dealerProfile) {
        echo "Shop Name: " . ($dealer->dealerProfile->dealer_shop_name ?: 'None') . PHP_EOL;
        echo "Dealer Code: " . ($dealer->dealerProfile->dealer_code ?: 'None') . PHP_EOL;
    } else {
        echo "No dealer profile found!" . PHP_EOL;
    }
    
    echo "---" . PHP_EOL;
}

// Test the specific logic used in header
echo PHP_EOL . "=== Testing Header Logic ===" . PHP_EOL;

// Simulate a request to a dealer showroom (e.g., abc dealer)
$test_shop_name = 'abc'; // You can change this to test different dealers

echo "Testing shop name: " . $test_shop_name . PHP_EOL;

$dealer = User::whereHas('dealerProfile', function($query) use ($test_shop_name) {
    $query->where('dealer_shop_name', $test_shop_name);
})->where('role', 'dealer')->with('dealerProfile')->first();

if ($dealer) {
    echo "✓ Found dealer for shop name '{$test_shop_name}': " . $dealer->name . PHP_EOL;
    echo "Profile Image: " . ($dealer->profile_image ?: 'None') . PHP_EOL;
    
    if ($dealer->profile_image) {
        echo "Will display: Profile image (" . $dealer->profile_image_url . ")" . PHP_EOL;
    } else {
        echo "Will display: Placeholder with first letter '" . substr($dealer->name, 0, 1) . "'" . PHP_EOL;
    }
} else {
    echo "✗ No dealer found for shop name '{$test_shop_name}'" . PHP_EOL;
    echo "Will display: Default store icon" . PHP_EOL;
}
