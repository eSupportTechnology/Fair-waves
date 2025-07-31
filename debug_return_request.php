<?php
require_once 'vendor/autoload.php';

use App\Models\SystemUser;
use App\Models\CustomerOrder;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->boot();

echo "=== Debugging Return Request Email System ===" . PHP_EOL;

// 1. Check if there are any Admin/Super Admin users
echo "1. Checking Admin Users..." . PHP_EOL;
$adminUsers = SystemUser::whereIn('role', ['Admin', 'Super Admin'])->get();

if ($adminUsers->isEmpty()) {
    echo "❌ NO ADMIN USERS FOUND! This is why emails are not being sent." . PHP_EOL;
    echo "You need to add Admin or Super Admin users to the system_users table." . PHP_EOL;
} else {
    echo "✓ Found " . $adminUsers->count() . " admin users:" . PHP_EOL;
    foreach ($adminUsers as $user) {
        echo "  - {$user->name} ({$user->email}) - Role: {$user->role}, Status: {$user->status}" . PHP_EOL;
    }
}

// 2. Check active admin users specifically
echo PHP_EOL . "2. Checking ACTIVE Admin Users..." . PHP_EOL;
$activeAdmins = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
    ->where('status', 'Active')
    ->get();

if ($activeAdmins->isEmpty()) {
    echo "❌ NO ACTIVE ADMIN USERS FOUND!" . PHP_EOL;
    echo "Admin users exist but their status is not 'Active'." . PHP_EOL;
    
    // Show what status values exist
    $allStatuses = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
        ->pluck('status')
        ->unique();
    echo "Current status values: " . $allStatuses->implode(', ') . PHP_EOL;
} else {
    echo "✓ Found " . $activeAdmins->count() . " active admin users:" . PHP_EOL;
    foreach ($activeAdmins as $user) {
        echo "  - {$user->name} ({$user->email})" . PHP_EOL;
    }
}

// 3. Test order validation
echo PHP_EOL . "3. Testing Order Validation..." . PHP_EOL;
echo "Checking if customer_orders table has data..." . PHP_EOL;

$orderCount = CustomerOrder::count();
echo "Total orders in database: {$orderCount}" . PHP_EOL;

if ($orderCount > 0) {
    $sampleOrder = CustomerOrder::first();
    echo "Sample order - Code: {$sampleOrder->order_code}, Customer: {$sampleOrder->customer_name}" . PHP_EOL;
    echo "Date format in DB: {$sampleOrder->date}" . PHP_EOL;
}

// 4. Check mail configuration
echo PHP_EOL . "4. Checking Mail Configuration..." . PHP_EOL;
echo "Mail Driver: " . config('mail.default') . PHP_EOL;
echo "Mail Host: " . config('mail.mailers.smtp.host') . PHP_EOL;
echo "Mail Port: " . config('mail.mailers.smtp.port') . PHP_EOL;
echo "Mail Username: " . config('mail.mailers.smtp.username') . PHP_EOL;

echo PHP_EOL . "=== END DEBUG ===" . PHP_EOL;
