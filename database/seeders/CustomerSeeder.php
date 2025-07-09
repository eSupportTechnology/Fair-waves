<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates 5 dummy customers with role="customer" and password="12345678"
     */
    public function run(): void
    {
        $dummyCustomers = [
            [
                'fname' => 'Alex',
                'lname' => 'Smith',
                'name' => 'Alex Smith',
                'email' => 'alex.smith@example.com',
                'phone' => '1122334455',
                'address' => '123 Pine Street, Anytown, USA',
                'gender' => 'Male',
                'dob' => Carbon::now()->subYears(32)->format('Y-m-d'),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'customer_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fname' => 'Sarah',
                'lname' => 'Johnson',
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '2233445566',
                'address' => '456 Oak Avenue, Somewhere, USA',
                'gender' => 'Female',
                'dob' => Carbon::now()->subYears(27)->format('Y-m-d'),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'customer_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fname' => 'David',
                'lname' => 'Williams',
                'name' => 'David Williams',
                'email' => 'david.williams@example.com',
                'phone' => '3344556677',
                'address' => '789 Maple Drive, Nowhere, USA',
                'gender' => 'Male',
                'dob' => Carbon::now()->subYears(45)->format('Y-m-d'),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'customer_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fname' => 'Jessica',
                'lname' => 'Brown',
                'name' => 'Jessica Brown',
                'email' => 'jessica.brown@example.com',
                'phone' => '4455667788',
                'address' => '321 Elm Street, Elsewhere, USA',
                'gender' => 'Female',
                'dob' => Carbon::now()->subYears(29)->format('Y-m-d'),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'customer_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fname' => 'Daniel',
                'lname' => 'Miller',
                'name' => 'Daniel Miller',
                'email' => 'daniel.miller@example.com',
                'phone' => '5566778899',
                'address' => '654 Birch Avenue, Anywhere, USA',
                'gender' => 'Male',
                'dob' => Carbon::now()->subYears(38)->format('Y-m-d'),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'customer_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($dummyCustomers as $customer) {
            // Check if a user with this email already exists
            if (!User::where('email', $customer['email'])->exists()) {
                User::create($customer);
            }
        }
    }
}
