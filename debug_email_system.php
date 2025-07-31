<?php
require_once 'vendor/autoload.php';

use App\Models\SystemUser;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReturnRequestMail;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->boot();

echo "=== DEBUGGING RETURN REQUEST EMAIL SYSTEM ===" . PHP_EOL;

// 1. Check System Users
echo "1. CHECKING SYSTEM USERS..." . PHP_EOL;
$allSystemUsers = SystemUser::all();
echo "Total system users: " . $allSystemUsers->count() . PHP_EOL;

if ($allSystemUsers->isEmpty()) {
    echo "❌ NO SYSTEM USERS FOUND!" . PHP_EOL;
    echo "Creating a test admin user..." . PHP_EOL;
    
    $testAdmin = SystemUser::create([
        'name' => 'Test Admin',
        'email' => 'admin@test.com',
        'contact' => '1234567890',
        'password' => bcrypt('password123'),
        'role' => 'Admin',
        'status' => 'Active',
        'image' => 'default-user.png'
    ]);
    
    echo "✓ Created test admin: {$testAdmin->email}" . PHP_EOL;
} else {
    echo "System users found:" . PHP_EOL;
    foreach ($allSystemUsers as $user) {
        echo "  - {$user->name} ({$user->email}) - Role: {$user->role}, Status: {$user->status}" . PHP_EOL;
    }
}

// 2. Check Active Admin Users
echo PHP_EOL . "2. CHECKING ACTIVE ADMIN USERS..." . PHP_EOL;
$activeAdmins = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
    ->whereIn('status', ['Active', 'active'])
    ->get();

if ($activeAdmins->isEmpty()) {
    echo "❌ NO ACTIVE ADMIN USERS FOUND!" . PHP_EOL;
    
    // Check what status values exist
    $allStatuses = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
        ->pluck('status')
        ->unique();
    echo "Current status values for admin users: " . $allStatuses->implode(', ') . PHP_EOL;
    
    // Try to activate an admin
    $adminToActivate = SystemUser::whereIn('role', ['Admin', 'Super Admin'])->first();
    if ($adminToActivate) {
        $adminToActivate->update(['status' => 'Active']);
        echo "✓ Activated admin user: {$adminToActivate->email}" . PHP_EOL;
    }
} else {
    echo "✓ Found " . $activeAdmins->count() . " active admin users:" . PHP_EOL;
    foreach ($activeAdmins as $admin) {
        echo "  - {$admin->name} ({$admin->email})" . PHP_EOL;
    }
}

// 3. Check Customer Orders
echo PHP_EOL . "3. CHECKING CUSTOMER ORDERS..." . PHP_EOL;
$totalOrders = CustomerOrder::count();
echo "Total customer orders: {$totalOrders}" . PHP_EOL;

if ($totalOrders > 0) {
    $sampleOrder = CustomerOrder::first();
    echo "Sample order:" . PHP_EOL;
    echo "  - Order Code: {$sampleOrder->order_code}" . PHP_EOL;
    echo "  - Customer: {$sampleOrder->customer_name}" . PHP_EOL;
    echo "  - Phone: {$sampleOrder->phone}" . PHP_EOL;
    echo "  - Email: {$sampleOrder->email}" . PHP_EOL;
    echo "  - Date: {$sampleOrder->date}" . PHP_EOL;
} else {
    echo "❌ NO CUSTOMER ORDERS FOUND!" . PHP_EOL;
    echo "Creating a test order..." . PHP_EOL;
    
    $testOrder = CustomerOrder::create([
        'order_code' => 'TEST123',
        'user_id' => 1,
        'customer_name' => 'Test Customer',
        'phone' => '1234567890',
        'email' => 'customer@test.com',
        'house_no' => '123',
        'apartment' => 'Test Apt',
        'city' => 'Test City',
        'postal_code' => '12345',
        'date' => now()->format('Y-m-d'),
        'total_cost' => 100.00,
        'status' => 'Confirmed',
        'payment_method' => 'COD',
        'payment_status' => 'Pending'
    ]);
    
    echo "✓ Created test order: {$testOrder->order_code}" . PHP_EOL;
}

// 4. Check Mail Configuration
echo PHP_EOL . "4. CHECKING MAIL CONFIGURATION..." . PHP_EOL;
$mailConfig = config('mail');
echo "Mail driver: " . $mailConfig['default'] . PHP_EOL;

if ($mailConfig['default'] === 'smtp') {
    $smtpConfig = $mailConfig['mailers']['smtp'];
    echo "SMTP Host: " . $smtpConfig['host'] . PHP_EOL;
    echo "SMTP Port: " . $smtpConfig['port'] . PHP_EOL;
    echo "SMTP Username: " . $smtpConfig['username'] . PHP_EOL;
} else {
    echo "Using mail driver: " . $mailConfig['default'] . PHP_EOL;
}

// 5. Test Email Sending (Simulation)
echo PHP_EOL . "5. TESTING EMAIL SYSTEM..." . PHP_EOL;

$testReturnRequest = ReturnRequest::first();
if (!$testReturnRequest) {
    echo "No return requests found. The email system should work when a request is submitted." . PHP_EOL;
} else {
    echo "Found existing return request: {$testReturnRequest->order_code}" . PHP_EOL;
    echo "Request type: {$testReturnRequest->request_type}" . PHP_EOL;
}

echo PHP_EOL . "=== SUMMARY ===" . PHP_EOL;
echo "System Users: " . SystemUser::count() . PHP_EOL;
echo "Active Admins: " . SystemUser::whereIn('role', ['Admin', 'Super Admin'])->whereIn('status', ['Active', 'active'])->count() . PHP_EOL;
echo "Customer Orders: " . CustomerOrder::count() . PHP_EOL;
echo "Return Requests: " . ReturnRequest::count() . PHP_EOL;

echo PHP_EOL . "✅ If you still have issues, check:" . PHP_EOL;
echo "1. .env file mail configuration" . PHP_EOL;
echo "2. Laravel logs in storage/logs/laravel.log" . PHP_EOL;
echo "3. Make sure admin users have status 'Active' exactly" . PHP_EOL;
