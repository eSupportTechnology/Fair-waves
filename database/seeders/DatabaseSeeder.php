<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create test user only if it doesn't exist
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Run the TV Product Seeder
        $this->call(TvProductSeeder::class);
        
        // Run the Home Appliance Seeder
        $this->call(HomeApplianceSeeder::class);
        
        // Run the Apple Product Seeder
        $this->call(AppleProductSeeder::class);
        
        // Run the Mobile Phone Seeder
        $this->call(MobilePhoneSeeder::class);
        
        // Run the Computer Seeder
        $this->call(ComputerSeeder::class);
        
        // Run the Kitchen Appliance Seeder
        $this->call(KitchenApplianceSeeder::class);
        
        // Run the Electronics Seeder
        $this->call(ElectronicsSeeder::class);
    }
}
