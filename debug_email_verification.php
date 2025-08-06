<?php

/**
 * Test script to debug email verification issues
 * This script will check a specific user and test verification
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\URL;

echo "=== EMAIL VERIFICATION DEBUG ===" . PHP_EOL;

try {
    // Find the user with email from your image (pramuditharadeeshan@gmail.com)
    $userEmail = 'pramuditharadeeshan@gmail.com';
    $user = User::where('email', $userEmail)->first();
    
    if (!$user) {
        echo "❌ User not found with email: {$userEmail}" . PHP_EOL;
        exit(1);
    }
    
    echo "✓ Found user: {$user->name} (ID: {$user->id})" . PHP_EOL;
    echo "Email: {$user->email}" . PHP_EOL;
    echo "Email verified at: " . ($user->email_verified_at ? $user->email_verified_at : 'NOT VERIFIED') . PHP_EOL;
    echo PHP_EOL;
    
    // Generate the verification URL that should work
    $userData = [
        'id' => $user->id,
        'email' => $user->email
    ];
    
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'email' => $user->email,
            'hash' => sha1($user->email)
        ]
    );
    
    echo "Generated verification URL:" . PHP_EOL;
    echo $verificationUrl . PHP_EOL;
    echo PHP_EOL;
    
    // Parse URL to show structure
    $parsed = parse_url($verificationUrl);
    echo "URL Structure:" . PHP_EOL;
    echo "Path: " . $parsed['path'] . PHP_EOL;
    echo "Query: " . ($parsed['query'] ?? 'None') . PHP_EOL;
    echo PHP_EOL;
    
    // Show hash information
    echo "Hash Information:" . PHP_EOL;
    echo "User email: " . $user->email . PHP_EOL;
    echo "Expected hash: " . sha1($user->email) . PHP_EOL;
    echo PHP_EOL;
    
    // Check if routes are properly configured
    echo "Route Check:" . PHP_EOL;
    $routes = app('router')->getRoutes();
    $verificationRoutes = collect($routes)->filter(function($route) {
        return $route->getName() === 'verification.verify';
    });
    
    if ($verificationRoutes->count() > 1) {
        echo "⚠️  WARNING: Multiple routes found with name 'verification.verify'" . PHP_EOL;
        foreach ($verificationRoutes as $route) {
            echo "  - " . $route->uri() . " → " . $route->getActionName() . PHP_EOL;
        }
    } else {
        $route = $verificationRoutes->first();
        if ($route) {
            echo "✓ Single verification route found:" . PHP_EOL;
            echo "  URI: " . $route->uri() . PHP_EOL;
            echo "  Action: " . $route->getActionName() . PHP_EOL;
        } else {
            echo "❌ No verification route found!" . PHP_EOL;
        }
    }
    echo PHP_EOL;
    
    // If user is not verified, show instructions
    if (!$user->hasVerifiedEmail()) {
        echo "=== INSTRUCTIONS ===" . PHP_EOL;
        echo "1. Copy the verification URL above" . PHP_EOL;
        echo "2. Open it in your browser" . PHP_EOL;
        echo "3. Check if it properly verifies the email" . PHP_EOL;
        echo "4. Try logging in after verification" . PHP_EOL;
    } else {
        echo "✅ User email is already verified!" . PHP_EOL;
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . ":" . $e->getLine() . PHP_EOL;
}
