<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\Vendor;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IPhoneProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get or create Mobile category
        $mobileCategory = Category::firstOrCreate(['name' => 'Mobile & Accessories']);

        // Create iPhone subcategory
        $iphoneSubcategory = Subcategory::firstOrCreate([
            'name' => 'iPhone',
            'category_id' => $mobileCategory->id
        ]);

        // Create iPhone sub-subcategories
        $iphone15SubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'iPhone 15 Series',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        $iphone14SubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'iPhone 14 Series',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        $iphone13SubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'iPhone 13 Series',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        // Get Apple brand
        $appleBrand = Brand::firstOrCreate(['slug' => 'apple'], [
            'name' => 'Apple',
            'is_top_brand' => true
        ]);

        // Get or create vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Electronics Store',
                'email' => 'vendor@electronics.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Electronics Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'ElectroMart',
                'shop_description' => 'Your one-stop shop for electronics',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // iPhone Products data
        $iphoneProducts = [
            [
                'product_name' => 'iPhone 15 Pro Max 256GB',
                'product_description' => 'The ultimate iPhone with Pro camera system, A17 Pro chip, and titanium design. Features advanced photography, all-day battery life, and USB-C connectivity.',
                'sub_subcategory_id' => $iphone15SubSubcategory->id,
                'brand_id' => $appleBrand->id,
                'normal_price' => 1199.99,
                'quantity' => 25,
                'tags' => 'iPhone, Apple, 15 Pro Max, Smartphone, Pro Camera',
                'is_affiliate' => true,
                'affiliate_price' => 1149.99,
                'commission_percentage' => 3.00,
                'bv' => 80,
                'images' => [
                    'https://via.placeholder.com/500x400/1D1D1F/FFFFFF?text=iPhone+15+Pro+Max+1',
                    'https://via.placeholder.com/500x400/1D1D1F/FFFFFF?text=iPhone+15+Pro+Max+2',
                    'https://via.placeholder.com/500x400/1D1D1F/FFFFFF?text=iPhone+15+Pro+Max+3'
                ]
            ],
            [
                'product_name' => 'iPhone 14 128GB Blue',
                'product_description' => 'iPhone 14 with advanced dual-camera system, A15 Bionic chip, and all-day battery life. Available in beautiful blue color.',
                'sub_subcategory_id' => $iphone14SubSubcategory->id,
                'brand_id' => $appleBrand->id,
                'normal_price' => 799.99,
                'quantity' => 40,
                'tags' => 'iPhone, Apple, 14, Blue, Smartphone, Dual Camera',
                'is_affiliate' => false,
                'bv' => 55,
                'images' => [
                    'https://via.placeholder.com/500x400/007AFF/FFFFFF?text=iPhone+14+Blue+1',
                    'https://via.placeholder.com/500x400/007AFF/FFFFFF?text=iPhone+14+Blue+2',
                    'https://via.placeholder.com/500x400/007AFF/FFFFFF?text=iPhone+14+Blue+3'
                ]
            ],
            [
                'product_name' => 'iPhone 13 Pro 512GB Sierra Blue',
                'product_description' => 'iPhone 13 Pro with ProRAW and ProRes capabilities, A15 Bionic with 5-core GPU, and Pro camera system with macro photography.',
                'sub_subcategory_id' => $iphone13SubSubcategory->id,
                'brand_id' => $appleBrand->id,
                'normal_price' => 949.99,
                'quantity' => 15,
                'tags' => 'iPhone, Apple, 13 Pro, Sierra Blue, Pro Camera, 512GB',
                'is_affiliate' => true,
                'affiliate_price' => 899.99,
                'commission_percentage' => 4.00,
                'bv' => 65,
                'images' => [
                    'https://via.placeholder.com/500x400/5A9FD4/FFFFFF?text=iPhone+13+Pro+1',
                    'https://via.placeholder.com/500x400/5A9FD4/FFFFFF?text=iPhone+13+Pro+2',
                    'https://via.placeholder.com/500x400/5A9FD4/FFFFFF?text=iPhone+13+Pro+3'
                ]
            ],
            [
                'product_name' => 'iPhone 15 256GB Pink',
                'product_description' => 'iPhone 15 with Dynamic Island, 48MP main camera, and USB-C. Beautiful pink finish with advanced camera features and all-day battery.',
                'sub_subcategory_id' => $iphone15SubSubcategory->id,
                'brand_id' => $appleBrand->id,
                'normal_price' => 899.99,
                'quantity' => 30,
                'tags' => 'iPhone, Apple, 15, Pink, Dynamic Island, USB-C',
                'is_affiliate' => false,
                'bv' => 60,
                'images' => [
                    'https://via.placeholder.com/500x400/FFB6C1/FFFFFF?text=iPhone+15+Pink+1',
                    'https://via.placeholder.com/500x400/FFB6C1/FFFFFF?text=iPhone+15+Pink+2',
                    'https://via.placeholder.com/500x400/FFB6C1/FFFFFF?text=iPhone+15+Pink+3'
                ]
            ]
        ];

        foreach ($iphoneProducts as $productData) {
            // Generate unique product ID
            $productId = 'IPHONE-' . strtoupper(Str::random(8));

            // Calculate commission price for affiliate products
            $commissionPrice = null;
            if ($productData['is_affiliate'] && isset($productData['commission_percentage'])) {
                $basePrice = $productData['affiliate_price'] ?? $productData['normal_price'];
                $commissionPrice = $basePrice * ($productData['commission_percentage'] / 100);
            }

            $product = Product::create([
                'product_id' => $productId,
                'shop_id' => $shop->id,
                'product_name' => $productData['product_name'],
                'product_description' => $productData['product_description'],
                'category_id' => $mobileCategory->id,
                'brand_id' => $productData['brand_id'],
                'subcategory_id' => $iphoneSubcategory->id,
                'sub_subcategory_id' => $productData['sub_subcategory_id'],
                'quantity' => $productData['quantity'],
                'tags' => $productData['tags'],
                'normal_price' => $productData['normal_price'],
                'is_affiliate' => $productData['is_affiliate'],
                'affiliate_price' => $productData['affiliate_price'] ?? null,
                'commission_percentage' => $productData['commission_percentage'] ?? null,
                'commission_price' => $commissionPrice,
                'bv' => $productData['bv'] ?? 0,
            ]);

            // Add product images
            $productImages = $productData['images'] ?? [];

            foreach ($productImages as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imageUrl
                ]);
            }

            $this->command->info("Created iPhone product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('iPhone products seeder completed successfully!');
    }
}
