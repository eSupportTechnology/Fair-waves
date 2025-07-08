<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'is_top_brand' => true,
            ],
            [
                'name' => 'Apple',
                'slug' => 'apple', 
                'is_top_brand' => true,
            ],
            [
                'name' => 'Sony',
                'slug' => 'sony',
                'is_top_brand' => true,
            ],
            [
                'name' => 'LG',
                'slug' => 'lg',
                'is_top_brand' => true,
            ],
            [
                'name' => 'Huawei',
                'slug' => 'huawei',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Xiaomi',
                'slug' => 'xiaomi',
                'is_top_brand' => false,
            ],
            [
                'name' => 'OnePlus',
                'slug' => 'oneplus',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Nokia',
                'slug' => 'nokia',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Panasonic',
                'slug' => 'panasonic',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Whirlpool',
                'slug' => 'whirlpool',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Bosch',
                'slug' => 'bosch',
                'is_top_brand' => false,
            ],
            [
                'name' => 'Philips',
                'slug' => 'philips',
                'is_top_brand' => false,
            ],
        ];

        foreach ($brands as $brandData) {
            Brand::firstOrCreate(
                ['slug' => $brandData['slug']],
                $brandData
            );
        }
    }
}
