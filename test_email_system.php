<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\SystemUser;
use App\Models\ReturnRequest;
use App\Mail\ReturnRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

try {
    echo "=== Testing Email System ===\n";
    
    // Check admin users
    $adminUsers = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
        ->where('status', 'Active')
        ->get();
    
    echo "Found " . $adminUsers->count() . " active admin users:\n";
    foreach ($adminUsers as $admin) {
        echo "- {$admin->name} ({$admin->email}) - Role: {$admin->role}\n";
    }
    
    // Create a test return request
    $testRequest = new ReturnRequest([
        'order_code' => 'TEST123',
        'customer_name' => 'Test Customer',
        'phone' => '1234567890',
        'email' => 'test@test.com',
        'order_date' => now()->format('Y-m-d'),
        'request_type' => 'return',
        'reason' => 'Test reason for return',
        'status' => 'pending'
    ]);
    
    // Test sending email to first admin
    if ($adminUsers->count() > 0) {
        $firstAdmin = $adminUsers->first();
        echo "\nTesting email to: {$firstAdmin->email}\n";
        
        try {
            Mail::to($firstAdmin->email)->send(new ReturnRequestMail($testRequest));
            echo "✓ Email sent successfully!\n";
        } catch (Exception $e) {
            echo "✗ Email failed: " . $e->getMessage() . "\n";
        }
    } else {
        echo "No admin users found to test email with.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
?>
