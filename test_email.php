<?php
require_once 'vendor/autoload.php';

use App\Models\SystemUser;
use App\Models\ReturnRequest;
use App\Mail\ReturnRequestMail;
use Illuminate\Support\Facades\Mail;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->boot();

echo "=== Testing Email System ===" . PHP_EOL;

// Get admin users
$adminUsers = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
    ->where('status', 'Active')
    ->get();

echo "Found " . $adminUsers->count() . " admin users:" . PHP_EOL;
foreach ($adminUsers as $admin) {
    echo "  - {$admin->name} ({$admin->email})" . PHP_EOL;
}

// Create a test return request
$testRequest = new ReturnRequest([
    'order_code' => 'TEST-ORDER-123',
    'customer_name' => 'Test Customer',
    'phone' => '0123456789',
    'email' => 'test@example.com',
    'order_date' => '2025-07-31',
    'request_type' => 'cancel',
    'cancel_reason' => 'Test cancellation reason for email template',
    'status' => 'pending'
]);

echo PHP_EOL . "Testing email template with test data..." . PHP_EOL;

try {
    // Test email template (without actually sending)
    $mailable = new ReturnRequestMail($testRequest);
    echo "✅ Email template loaded successfully" . PHP_EOL;
    
    // Test sending to first admin
    if ($adminUsers->count() > 0) {
        $firstAdmin = $adminUsers->first();
        echo "Sending test email to: {$firstAdmin->email}" . PHP_EOL;
        
        Mail::to($firstAdmin->email)->send($mailable);
        echo "✅ Test email sent successfully!" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "Email test completed." . PHP_EOL;
