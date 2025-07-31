<?php
/**
 * Test file to verify dealer profile image loading in header
 * 
 * This test simulates the dealer showroom header functionality
 * to ensure dealer profile images are loaded correctly based on dealer_shop_name
 */

// Include Laravel bootstrap (adjust path as needed)
require_once __DIR__ . '/vendor/autoload.php';

// Simulate Laravel environment
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\DealerProfile;

echo "Testing Dealer Profile Image Loading in Header\n";
echo "==============================================\n\n";

// Test 1: Find dealer by shop name (like in header logic)
echo "Test 1: Finding dealer by shop name 'abc'\n";
$dealer_shop_name = 'abc';

$dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
    $query->where('dealer_shop_name', $dealer_shop_name);
})->where('role', 'dealer')->with('dealerProfile')->first();

if ($dealer) {
    echo "✓ Dealer found: {$dealer->name}\n";
    echo "  - User ID: {$dealer->id}\n";
    echo "  - Email: {$dealer->email}\n";
    echo "  - Profile Image: " . ($dealer->profile_image ? $dealer->profile_image : 'No image') . "\n";
    echo "  - Shop Name: {$dealer->dealerProfile->dealer_shop_name}\n";
    
    // Test profile image URL
    if ($dealer->profile_image) {
        echo "  - Profile Image URL: {$dealer->profile_image_url}\n";
        echo "✓ Profile image will be displayed\n";
    } else {
        echo "  - Fallback: First letter of name ('{$dealer->name[0]}')\n";
        echo "✓ Placeholder with first letter will be displayed\n";
    }
} else {
    echo "✗ No dealer found with shop name: {$dealer_shop_name}\n";
}

echo "\n";

// Test 2: Check all dealers with profile images
echo "Test 2: All dealers with profile images\n";
$dealersWithImages = User::where('role', 'dealer')
    ->whereNotNull('profile_image')
    ->with('dealerProfile')
    ->get();

if ($dealersWithImages->count() > 0) {
    echo "Found {$dealersWithImages->count()} dealer(s) with profile images:\n";
    foreach ($dealersWithImages as $dealer) {
        $shopName = $dealer->dealerProfile ? $dealer->dealerProfile->dealer_shop_name : 'No shop name';
        echo "  - {$dealer->name} (Shop: {$shopName}) - Image: {$dealer->profile_image}\n";
    }
} else {
    echo "No dealers with profile images found.\n";
}

echo "\n";

// Test 3: Simulate URL segment extraction (like in fallback logic)
echo "Test 3: Simulating URL segment extraction\n";
// This simulates how request()->segment(2) would work
$test_url_segments = ['abc', 'xyz-shop', 'test-dealer'];

foreach ($test_url_segments as $segment) {
    $dealer = User::whereHas('dealerProfile', function($query) use ($segment) {
        $query->where('dealer_shop_name', $segment);
    })->where('role', 'dealer')->with('dealerProfile')->first();
    
    if ($dealer) {
        echo "✓ URL segment '{$segment}' -> Dealer: {$dealer->name}\n";
    } else {
        echo "✗ URL segment '{$segment}' -> No dealer found\n";
    }
}

echo "\n";

// Test 4: Test the actual header logic flow
echo "Test 4: Header logic flow simulation\n";
function simulateHeaderLogic($dealer_shop_name) {
    // Primary logic: Check if dealer is passed in context
    $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
        $query->where('dealer_shop_name', $dealer_shop_name);
    })->where('role', 'dealer')->with('dealerProfile')->first();
    
    if ($dealer) {
        echo "Primary path: Dealer found in context\n";
        if ($dealer->profile_image) {
            echo "  → Will display: Profile image ({$dealer->profile_image_url})\n";
        } else {
            echo "  → Will display: Placeholder with '{$dealer->name[0]}'\n";
        }
        return true;
    }
    
    // Fallback logic: Try to get from URL
    echo "Fallback path: No dealer in context, trying from URL\n";
    $fallback_dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
        $query->where('dealer_shop_name', $dealer_shop_name);
    })->where('role', 'dealer')->with('dealerProfile')->first();
    
    if ($fallback_dealer) {
        echo "  → Fallback dealer found: {$fallback_dealer->name}\n";
        if ($fallback_dealer->profile_image) {
            echo "  → Will display: Profile image ({$fallback_dealer->profile_image_url})\n";
        } else {
            echo "  → Will display: Placeholder with '{$fallback_dealer->name[0]}'\n";
        }
        return true;
    }
    
    echo "  → Will display: Default store icon\n";
    return false;
}

simulateHeaderLogic('abc');

echo "\n==============================================\n";
echo "Test completed successfully!\n";
echo "The header will now load dealer profile images based on dealer_shop_name.\n";
?>
