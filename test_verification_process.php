<?php

/**
 * Test script to simulate email verification process
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Http\Controllers\Auth\CustomEmailVerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

echo "=== EMAIL VERIFICATION SIMULATION ===" . PHP_EOL;

try {
    // Find the user
    $user = User::where('email', 'pramuditharadeeshan@gmail.com')->first();
    
    if (!$user) {
        echo "❌ User not found!" . PHP_EOL;
        exit(1);
    }
    
    echo "Testing verification for user: {$user->name} (ID: {$user->id})" . PHP_EOL;
    echo "Current verification status: " . ($user->hasVerifiedEmail() ? 'VERIFIED' : 'NOT VERIFIED') . PHP_EOL;
    echo PHP_EOL;
    
    if (!$user->hasVerifiedEmail()) {
        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'email' => $user->email,
                'hash' => sha1($user->email)
            ]
        );
        
        echo "Generated URL: " . $verificationUrl . PHP_EOL;
        echo PHP_EOL;
        
        // Parse the URL to extract components
        $parsed = parse_url($verificationUrl);
        parse_str($parsed['query'], $queryParams);
        $pathParts = explode('/', trim($parsed['path'], '/'));
        
        // Extract parameters
        $userId = $pathParts[1];
        $userEmail = $pathParts[2];
        $hash = $pathParts[3];
        
        echo "Extracted parameters:" . PHP_EOL;
        echo "ID: {$userId}" . PHP_EOL;
        echo "Email: {$userEmail}" . PHP_EOL;
        echo "Hash: {$hash}" . PHP_EOL;
        echo "Expires: {$queryParams['expires']}" . PHP_EOL;
        echo "Signature: {$queryParams['signature']}" . PHP_EOL;
        echo PHP_EOL;
        
        // Create a fake request to simulate the verification
        $request = Request::create($verificationUrl, 'GET');
        $request->setRouteResolver(function () use ($userId, $userEmail, $hash, $request) {
            $route = new \Illuminate\Routing\Route('GET', 'verify-email/{id}/{email}/{hash}', []);
            $route->bind($request);
            $route->setParameter('id', $userId);
            $route->setParameter('email', $userEmail);
            $route->setParameter('hash', $hash);
            return $route;
        });
        
        // Manually verify the email
        echo "Manually verifying email..." . PHP_EOL;
        
        // Validate signature
        if (!URL::hasValidSignature($request)) {
            echo "❌ Invalid signature!" . PHP_EOL;
        } else {
            echo "✓ Valid signature" . PHP_EOL;
            
            // Check hash
            $expectedHash = sha1($user->email);
            if ($hash === $expectedHash) {
                echo "✓ Hash matches" . PHP_EOL;
                
                // Update user
                $user->email_verified_at = now();
                $user->save();
                
                echo "✅ EMAIL VERIFIED SUCCESSFULLY!" . PHP_EOL;
                echo "User {$user->name} can now log in." . PHP_EOL;
                
                // Verify the update worked
                $user->refresh();
                echo "Updated verification status: " . ($user->hasVerifiedEmail() ? 'VERIFIED' : 'NOT VERIFIED') . PHP_EOL;
                echo "Verified at: " . $user->email_verified_at . PHP_EOL;
                
            } else {
                echo "❌ Hash mismatch!" . PHP_EOL;
                echo "Expected: {$expectedHash}" . PHP_EOL;
                echo "Got: {$hash}" . PHP_EOL;
            }
        }
    } else {
        echo "✅ User email is already verified!" . PHP_EOL;
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . ":" . $e->getLine() . PHP_EOL;
}
