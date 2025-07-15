<?php
require_once 'vendor/autoload.php';

use App\Models\User;

// Check if Laravel is bootstrapped
if (!app()->bound('config')) {
    // Bootstrap Laravel
    $app = require_once 'bootstrap/app.php';
    $app->boot();
}

// Get all users with profile images
$users = User::whereNotNull('profile_image')->get(['id', 'name', 'email', 'profile_image']);

echo "Users with profile images:\n";
foreach ($users as $user) {
    echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Profile Image: {$user->profile_image}\n";
}

// Check if storage directory exists
$storagePath = storage_path('app/public/profile_images');
echo "\nStorage path exists: " . (file_exists($storagePath) ? 'YES' : 'NO') . "\n";
echo "Storage path: {$storagePath}\n";

// Check if public storage link exists
$publicStoragePath = public_path('storage');
echo "Public storage link exists: " . (file_exists($publicStoragePath) ? 'YES' : 'NO') . "\n";
echo "Public storage path: {$publicStoragePath}\n";
