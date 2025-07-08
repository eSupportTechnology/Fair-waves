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

class TvProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Use existing Electronics category with ID 18
        $electronicsCategory = Category::find(18);
        if (!$electronicsCategory) {
            $electronicsCategory = Category::firstOrCreate(['name' => 'Electronics']);
        }

        // Create TV subcategory
        $tvSubcategory = Subcategory::firstOrCreate([
            'name' => 'Television',
            'category_id' => $electronicsCategory->id
        ]);

        // Create TV sub-subcategories
        $smartTvSubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'Smart TV',
            'subcategory_id' => $tvSubcategory->id
        ]);

        $ledTvSubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'LED TV',
            'subcategory_id' => $tvSubcategory->id
        ]);

        $oledTvSubSubcategory = SubSubcategory::firstOrCreate([
            'name' => 'OLED TV',
            'subcategory_id' => $tvSubcategory->id
        ]);

        // Create a sample vendor and shop if they don't exist
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

        // Get or create brands
        $samsungBrand = Brand::firstOrCreate(['slug' => 'samsung'], [
            'name' => 'Samsung',
            'is_top_brand' => true
        ]);
        
        $lgBrand = Brand::firstOrCreate(['slug' => 'lg'], [
            'name' => 'LG',
            'is_top_brand' => true
        ]);
        
        $sonyBrand = Brand::firstOrCreate(['slug' => 'sony'], [
            'name' => 'Sony',
            'is_top_brand' => true
        ]);

        // TV Products data with real images
        $tvProducts = [
            [
                'product_name' => 'Samsung 55" 4K Smart LED TV',
                'product_description' => 'Experience stunning 4K Ultra HD picture quality with this Samsung Smart TV. Features include HDR10+ support, Tizen OS, voice control, and multiple streaming apps built-in.',
                'sub_subcategory_id' => $smartTvSubSubcategory->id,
                'brand_id' => $samsungBrand->id,
                'normal_price' => 899.99,
                'quantity' => 25,
                'tags' => 'Samsung, 4K, Smart TV, LED, HDR, Streaming',
                'is_affiliate' => false,
                'bv' => 50,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+55+4K+TV+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+55+4K+TV+2',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+55+4K+TV+3'
                ]
            ],
            [
                'product_name' => 'LG 65" OLED 4K Smart TV',
                'product_description' => 'Premium OLED technology delivers perfect blacks and infinite contrast. Features webOS, Dolby Vision, and AI ThinQ for the ultimate viewing experience.',
                'sub_subcategory_id' => $oledTvSubSubcategory->id,
                'brand_id' => $lgBrand->id,
                'normal_price' => 1599.99,
                'quantity' => 15,
                'tags' => 'LG, OLED, 4K, Smart TV, Dolby Vision, webOS',
                'is_affiliate' => true,
                'affiliate_price' => 1499.99,
                'commission_percentage' => 5.00,
                'bv' => 100,
                'images' => [
                    'https://via.placeholder.com/500x400/A50034/FFFFFF?text=LG+65+OLED+TV+1',
                    'https://via.placeholder.com/500x400/A50034/FFFFFF?text=LG+65+OLED+TV+2',
                    'https://via.placeholder.com/500x400/A50034/FFFFFF?text=LG+65+OLED+TV+3'
                ]
            ],
            [
                'product_name' => 'Sony 43" LED Full HD TV',
                'product_description' => 'Affordable Full HD LED TV with excellent picture quality. Perfect for bedrooms or smaller living spaces. Features multiple HDMI ports and USB connectivity.',
                'sub_subcategory_id' => $ledTvSubSubcategory->id,
                'brand_id' => $sonyBrand->id,
                'normal_price' => 399.99,
                'quantity' => 40,
                'tags' => 'Sony, LED, Full HD, Budget TV, HDMI',
                'is_affiliate' => false,
                'bv' => 25,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+43+LED+TV+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+43+LED+TV+2',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+43+LED+TV+3'
                ]
            ],
            [
                'product_name' => 'TCL 50" 4K QLED Smart TV',
                'product_description' => 'Quantum Dot technology delivers vibrant colors and enhanced brightness. Includes Roku TV platform with thousands of streaming channels.',
                'sub_subcategory_id' => $smartTvSubSubcategory->id,
                'normal_price' => 649.99,
                'quantity' => 30,
                'tags' => 'TCL, QLED, 4K, Smart TV, Roku, Quantum Dot',
                'is_affiliate' => true,
                'affiliate_price' => 599.99,
                'commission_percentage' => 7.50,
                'bv' => 40,
                'images' => [
                    'https://via.placeholder.com/500x400/FF6900/FFFFFF?text=TCL+50+QLED+TV+1',
                    'https://via.placeholder.com/500x400/FF6900/FFFFFF?text=TCL+50+QLED+TV+2',
                    'https://via.placeholder.com/500x400/FF6900/FFFFFF?text=TCL+50+QLED+TV+3'
                ]
            ],
            [
                'product_name' => 'Hisense 75" 4K UHD Smart TV',
                'product_description' => 'Large 75-inch display with 4K Ultra HD resolution. Features Android TV platform, voice remote, and Dolby Audio for immersive entertainment.',
                'sub_subcategory_id' => $smartTvSubSubcategory->id,
                'normal_price' => 1199.99,
                'quantity' => 10,
                'tags' => 'Hisense, 75 inch, 4K, Smart TV, Android TV, Large Screen',
                'is_affiliate' => false,
                'bv' => 75,
                'images' => [
                    'https://via.placeholder.com/500x400/36454F/FFFFFF?text=Hisense+75+UHD+TV+1',
                    'https://via.placeholder.com/500x400/36454F/FFFFFF?text=Hisense+75+UHD+TV+2',
                    'https://via.placeholder.com/500x400/36454F/FFFFFF?text=Hisense+75+UHD+TV+3'
                ]
            ]
        ];

        foreach ($tvProducts as $productData) {
            // Generate unique product ID
            $productId = 'TV-' . strtoupper(Str::random(8));

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
                'category_id' => $electronicsCategory->id,
                'brand_id' => $productData['brand_id'] ?? null,
                'subcategory_id' => $tvSubcategory->id,
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

            // Add real product images
            $productImages = $productData['images'] ?? [];

            foreach ($productImages as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imageUrl
                ]);
            }

            $this->command->info("Created TV product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('TV products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Electronics category');
        $this->command->info('- Television subcategory');
        $this->command->info('- Smart TV, LED TV, OLED TV sub-subcategories');
        $this->command->info('- ' . count($tvProducts) . ' TV products with images');
    }
}
