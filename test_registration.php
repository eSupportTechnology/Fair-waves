<?php

// Simple test script to test registration functionality
require_once 'vendor/autoload.php';

use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

// Test data
$userData = [
    'fname' => 'Test',
    'lname' => 'User',
    'email' => 'test@example.com',
    'password' => 'password123',
    'address' => '123 Test Street',
    'dob' => '1990-01-01',
    'phone' => '1234567890',
];

echo "Testing email verification mail...\n";

try {
    $mail = new EmailVerificationMail($userData);
    echo "Email verification mail created successfully!\n";
    echo "Subject: " . $mail->subject . "\n";
    echo "Verification URL created: " . (empty($mail->verificationUrl) ? 'No' : 'Yes') . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\nTest completed.\n";
