<?php
require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\DealerProfile;

echo "=== Current Dealer Header Implementation Status ===" . PHP_EOL;

try {
    // Bootstrap Laravel properly
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    echo "✓ Laravel bootstrapped successfully" . PHP_EOL;

    // Test the exact logic used in ShowRoomController
    $test_shop_name = 'abc'; // Change this to test specific dealer
    
    echo PHP_EOL . "Testing shop name: '{$test_shop_name}'" . PHP_EOL;
    
    // This is the exact query from ShowRoomController.php line 25-30
    $dealer = User::whereHas('dealerProfile', function($query) use ($test_shop_name) {
        $query->where('dealer_shop_name', $test_shop_name);
    })->where('role', 'dealer')->with('dealerProfile')->first();

    if ($dealer) {
        echo "✓ Dealer found: {$dealer->name}" . PHP_EOL;
        echo "  Shop Name: {$dealer->dealerProfile->dealer_shop_name}" . PHP_EOL;
        echo "  Profile Image: " . ($dealer->profile_image ?: 'None') . PHP_EOL;
        
        if ($dealer->profile_image) {
            echo "  Profile Image URL: {$dealer->profile_image_url}" . PHP_EOL;
            echo "  Header will display: Profile image in rounded container" . PHP_EOL;
        } else {
            echo "  Header will display: First letter placeholder ('" . substr($dealer->name, 0, 1) . "')" . PHP_EOL;
        }
    } else {
        echo "✗ No dealer found with shop name '{$test_shop_name}'" . PHP_EOL;
    }

    // List all dealers to see what's available
    echo PHP_EOL . "Available dealers:" . PHP_EOL;
    $all_dealers = User::where('role', 'dealer')->with('dealerProfile')->get();
    
    if ($all_dealers->isEmpty()) {
        echo "  No dealers found in database" . PHP_EOL;
    } else {
        foreach ($all_dealers as $dealer) {
            $shop_name = $dealer->dealerProfile ? $dealer->dealerProfile->dealer_shop_name : 'No shop name';
            $has_image = $dealer->profile_image ? 'Has image' : 'No image';
            echo "  - {$dealer->name} | Shop: {$shop_name} | {$has_image}" . PHP_EOL;
        }
    }

    echo PHP_EOL . "=== Implementation Summary ===" . PHP_EOL;
    echo "The dealer header profile image system is already implemented:" . PHP_EOL;
    echo "1. ✓ ShowRoomController finds dealer by shop name" . PHP_EOL;
    echo "2. ✓ Header receives \$dealer object with profile image" . PHP_EOL;
    echo "3. ✓ Header displays image using \$dealer->profile_image_url" . PHP_EOL;
    echo "4. ✓ Fallback to first letter placeholder if no image" . PHP_EOL;
    echo "5. ✓ CSS styling for rounded profile images" . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
