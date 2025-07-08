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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KitchenApplianceSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Kitchen Appliances category
        $kitchenCategory = Category::firstOrCreate(['name' => 'Kitchen Appliances']);

        // Create subcategories
        $cookingApplianceSubcategory = Subcategory::firstOrCreate([
            'name' => 'Cooking Appliances',
            'category_id' => $kitchenCategory->id
        ]);

        $smallApplianceSubcategory = Subcategory::firstOrCreate([
            'name' => 'Small Kitchen Appliances',
            'category_id' => $kitchenCategory->id
        ]);

        $foodProcessorSubcategory = Subcategory::firstOrCreate([
            'name' => 'Food Processors & Blenders',
            'category_id' => $kitchenCategory->id
        ]);

        $coffeeTeaSubcategory = Subcategory::firstOrCreate([
            'name' => 'Coffee & Tea Makers',
            'category_id' => $kitchenCategory->id
        ]);

        $cookwareSubcategory = Subcategory::firstOrCreate([
            'name' => 'Cookware & Bakeware',
            'category_id' => $kitchenCategory->id
        ]);

        $kitchenToolsSubcategory = Subcategory::firstOrCreate([
            'name' => 'Kitchen Tools & Gadgets',
            'category_id' => $kitchenCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // Cooking Appliances sub-subcategories
        $microwaveOven = SubSubcategory::firstOrCreate([
            'name' => 'Microwave Ovens',
            'subcategory_id' => $cookingApplianceSubcategory->id
        ]);

        $ovenToaster = SubSubcategory::firstOrCreate([
            'name' => 'Oven Toaster Grills',
            'subcategory_id' => $cookingApplianceSubcategory->id
        ]);

        $inductionCooktop = SubSubcategory::firstOrCreate([
            'name' => 'Induction Cooktops',
            'subcategory_id' => $cookingApplianceSubcategory->id
        ]);

        // Small Kitchen Appliances sub-subcategories
        $mixer = SubSubcategory::firstOrCreate([
            'name' => 'Mixers & Grinders',
            'subcategory_id' => $smallApplianceSubcategory->id
        ]);

        $riceCooker = SubSubcategory::firstOrCreate([
            'name' => 'Rice Cookers',
            'subcategory_id' => $smallApplianceSubcategory->id
        ]);

        $electricKettle = SubSubcategory::firstOrCreate([
            'name' => 'Electric Kettles',
            'subcategory_id' => $smallApplianceSubcategory->id
        ]);

        // Food Processors & Blenders sub-subcategories
        $foodProcessor = SubSubcategory::firstOrCreate([
            'name' => 'Food Processors',
            'subcategory_id' => $foodProcessorSubcategory->id
        ]);

        $blender = SubSubcategory::firstOrCreate([
            'name' => 'Blenders',
            'subcategory_id' => $foodProcessorSubcategory->id
        ]);

        $juicer = SubSubcategory::firstOrCreate([
            'name' => 'Juicers',
            'subcategory_id' => $foodProcessorSubcategory->id
        ]);

        // Coffee & Tea Makers sub-subcategories
        $coffeeMaker = SubSubcategory::firstOrCreate([
            'name' => 'Coffee Makers',
            'subcategory_id' => $coffeeTeaSubcategory->id
        ]);

        $espressoMachine = SubSubcategory::firstOrCreate([
            'name' => 'Espresso Machines',
            'subcategory_id' => $coffeeTeaSubcategory->id
        ]);

        $teaMaker = SubSubcategory::firstOrCreate([
            'name' => 'Tea Makers',
            'subcategory_id' => $coffeeTeaSubcategory->id
        ]);

        // Cookware & Bakeware sub-subcategories
        $nonStickCookware = SubSubcategory::firstOrCreate([
            'name' => 'Non-Stick Cookware',
            'subcategory_id' => $cookwareSubcategory->id
        ]);

        $stainlessSteelCookware = SubSubcategory::firstOrCreate([
            'name' => 'Stainless Steel Cookware',
            'subcategory_id' => $cookwareSubcategory->id
        ]);

        $bakeware = SubSubcategory::firstOrCreate([
            'name' => 'Baking Pans & Molds',
            'subcategory_id' => $cookwareSubcategory->id
        ]);

        // Kitchen Tools & Gadgets sub-subcategories
        $knivesSet = SubSubcategory::firstOrCreate([
            'name' => 'Knife Sets',
            'subcategory_id' => $kitchenToolsSubcategory->id
        ]);

        $cuttingBoard = SubSubcategory::firstOrCreate([
            'name' => 'Cutting Boards',
            'subcategory_id' => $kitchenToolsSubcategory->id
        ]);

        $kitchenGadgets = SubSubcategory::firstOrCreate([
            'name' => 'Kitchen Gadgets',
            'subcategory_id' => $kitchenToolsSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Kitchen Appliance Store',
                'email' => 'vendor@kitchenappliances.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Kitchen Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'KitchenMart',
                'shop_description' => 'Your one-stop shop for kitchen appliances',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Kitchen Appliance Products data
        $kitchenProducts = [
            // Cooking Appliances
            [
                'product_name' => 'Samsung 28L Convection Microwave Oven',
                'product_description' => 'Multi-function microwave with convection cooking, grill, and auto-cook menus. Features ceramic enamel cavity for easy cleaning and even heating.',
                'subcategory_id' => $cookingApplianceSubcategory->id,
                'sub_subcategory_id' => $microwaveOven->id,
                'normal_price' => 15999.99,
                'quantity' => 20,
                'tags' => 'Samsung, Microwave, Convection, Grill, Auto-cook',
                'is_affiliate' => true,
                'affiliate_price' => 14999.99,
                'commission_percentage' => 5.00,
                'bv' => 120,
                'images' => [
                    'https://via.placeholder.com/400x300/FF6B35/FFF?text=Samsung+Microwave',
                    'https://via.placeholder.com/400x300/FF6B35/FFF?text=Samsung+Microwave+2'
                ]
            ],
            [
                'product_name' => 'Bajaj 42L Oven Toaster Grill',
                'product_description' => 'Large capacity OTG with motorized rotisserie, convection, and temperature control. Perfect for baking, grilling, and toasting.',
                'subcategory_id' => $cookingApplianceSubcategory->id,
                'sub_subcategory_id' => $ovenToaster->id,
                'normal_price' => 8999.99,
                'quantity' => 15,
                'tags' => 'Bajaj, OTG, Oven, Toaster, Grill, Rotisserie',
                'is_affiliate' => false,
                'bv' => 75,
                'images' => [
                    'https://via.placeholder.com/400x300/28A745/FFF?text=Bajaj+OTG',
                    'https://via.placeholder.com/400x300/28A745/FFF?text=Bajaj+OTG+2'
                ]
            ],
            [
                'product_name' => 'Prestige 2000W Induction Cooktop',
                'product_description' => 'Energy-efficient induction cooktop with preset cooking functions, timer, and automatic voltage regulator. Compatible with induction-ready cookware.',
                'subcategory_id' => $cookingApplianceSubcategory->id,
                'sub_subcategory_id' => $inductionCooktop->id,
                'normal_price' => 3499.99,
                'quantity' => 30,
                'tags' => 'Prestige, Induction, Cooktop, Energy Efficient, Timer',
                'is_affiliate' => true,
                'affiliate_price' => 3199.99,
                'commission_percentage' => 8.00,
                'bv' => 40,
                'images' => [
                    'https://via.placeholder.com/400x300/6F42C1/FFF?text=Prestige+Induction',
                    'https://via.placeholder.com/400x300/6F42C1/FFF?text=Prestige+Induction+2'
                ]
            ],

            // Small Kitchen Appliances
            [
                'product_name' => 'Preethi Zodiac 750W Mixer Grinder',
                'product_description' => '3-jar mixer grinder with powerful motor, stainless steel jars, and safety features. Perfect for grinding, blending, and mixing.',
                'subcategory_id' => $smallApplianceSubcategory->id,
                'sub_subcategory_id' => $mixer->id,
                'normal_price' => 5999.99,
                'quantity' => 25,
                'tags' => 'Preethi, Mixer, Grinder, 3 Jar, Stainless Steel',
                'is_affiliate' => true,
                'affiliate_price' => 5499.99,
                'commission_percentage' => 6.00,
                'bv' => 50,
                'images' => [
                    'https://via.placeholder.com/400x300/DC3545/FFF?text=Preethi+Mixer',
                    'https://via.placeholder.com/400x300/DC3545/FFF?text=Preethi+Mixer+2'
                ]
            ],
            [
                'product_name' => 'Panasonic 1.8L Electric Rice Cooker',
                'product_description' => 'Automatic rice cooker with keep-warm function, non-stick inner pot, and steam basket. Cooks perfect rice every time.',
                'subcategory_id' => $smallApplianceSubcategory->id,
                'sub_subcategory_id' => $riceCooker->id,
                'normal_price' => 2999.99,
                'quantity' => 40,
                'tags' => 'Panasonic, Rice Cooker, Keep Warm, Non-stick, Steam',
                'is_affiliate' => false,
                'bv' => 30,
                'images' => [
                    'https://via.placeholder.com/400x300/FFC107/000?text=Panasonic+Rice+Cooker',
                    'https://via.placeholder.com/400x300/FFC107/000?text=Panasonic+Rice+Cooker+2'
                ]
            ],
            [
                'product_name' => 'Philips 1.5L Electric Kettle',
                'product_description' => 'Fast boiling electric kettle with auto shut-off, dry boil protection, and stainless steel body. Boils water in minutes.',
                'subcategory_id' => $smallApplianceSubcategory->id,
                'sub_subcategory_id' => $electricKettle->id,
                'normal_price' => 1799.99,
                'quantity' => 50,
                'tags' => 'Philips, Electric Kettle, Auto Shut-off, Stainless Steel',
                'is_affiliate' => true,
                'affiliate_price' => 1599.99,
                'commission_percentage' => 10.00,
                'bv' => 20,
                'images' => [
                    'https://via.placeholder.com/400x300/17A2B8/FFF?text=Philips+Kettle',
                    'https://via.placeholder.com/400x300/17A2B8/FFF?text=Philips+Kettle+2'
                ]
            ],

            // Food Processors & Blenders
            [
                'product_name' => 'Cuisinart 14-Cup Food Processor',
                'product_description' => 'Large capacity food processor with multiple blades and discs. Perfect for chopping, slicing, shredding, and mixing large quantities.',
                'subcategory_id' => $foodProcessorSubcategory->id,
                'sub_subcategory_id' => $foodProcessor->id,
                'normal_price' => 12999.99,
                'quantity' => 12,
                'tags' => 'Cuisinart, Food Processor, 14 Cup, Multiple Blades',
                'is_affiliate' => true,
                'affiliate_price' => 11999.99,
                'commission_percentage' => 4.00,
                'bv' => 100,
                'images' => [
                    'https://via.placeholder.com/400x300/343A40/FFF?text=Cuisinart+Processor',
                    'https://via.placeholder.com/400x300/343A40/FFF?text=Cuisinart+Processor+2'
                ]
            ],
            [
                'product_name' => 'Vitamix High-Speed Blender',
                'product_description' => 'Professional-grade blender with variable speed control and pulse feature. Creates smoothies, soups, and nut butters with ease.',
                'subcategory_id' => $foodProcessorSubcategory->id,
                'sub_subcategory_id' => $blender->id,
                'normal_price' => 24999.99,
                'quantity' => 8,
                'tags' => 'Vitamix, High Speed, Blender, Professional, Variable Speed',
                'is_affiliate' => true,
                'affiliate_price' => 22999.99,
                'commission_percentage' => 3.00,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/400x300/20C997/FFF?text=Vitamix+Blender',
                    'https://via.placeholder.com/400x300/20C997/FFF?text=Vitamix+Blender+2'
                ]
            ],
            [
                'product_name' => 'Omega Slow Masticating Juicer',
                'product_description' => 'Cold press juicer that preserves nutrients and enzymes. Low-speed masticating technology for maximum juice extraction.',
                'subcategory_id' => $foodProcessorSubcategory->id,
                'sub_subcategory_id' => $juicer->id,
                'normal_price' => 18999.99,
                'quantity' => 10,
                'tags' => 'Omega, Slow Juicer, Cold Press, Masticating, Nutrient',
                'is_affiliate' => false,
                'bv' => 150,
                'images' => [
                    'https://via.placeholder.com/400x300/6C757D/FFF?text=Omega+Juicer',
                    'https://via.placeholder.com/400x300/6C757D/FFF?text=Omega+Juicer+2'
                ]
            ],

            // Coffee & Tea Makers
            [
                'product_name' => 'Breville Barista Express Espresso Machine',
                'product_description' => 'Semi-automatic espresso machine with built-in grinder, steam wand, and pressure gauge. Create café-quality espresso at home.',
                'subcategory_id' => $coffeeTeaSubcategory->id,
                'sub_subcategory_id' => $espressoMachine->id,
                'normal_price' => 45999.99,
                'quantity' => 5,
                'tags' => 'Breville, Espresso, Built-in Grinder, Steam Wand, Semi-automatic',
                'is_affiliate' => true,
                'affiliate_price' => 42999.99,
                'commission_percentage' => 2.50,
                'bv' => 350,
                'images' => [
                    'https://via.placeholder.com/400x300/795548/FFF?text=Breville+Espresso',
                    'https://via.placeholder.com/400x300/795548/FFF?text=Breville+Espresso+2'
                ]
            ],
            [
                'product_name' => 'Ninja 12-Cup Programmable Coffee Maker',
                'product_description' => 'Programmable drip coffee maker with thermal carafe, adjustable warming plate, and auto shut-off. Brews rich, flavorful coffee.',
                'subcategory_id' => $coffeeTeaSubcategory->id,
                'sub_subcategory_id' => $coffeeMaker->id,
                'normal_price' => 7999.99,
                'quantity' => 18,
                'tags' => 'Ninja, Coffee Maker, Programmable, Thermal Carafe, 12 Cup',
                'is_affiliate' => true,
                'affiliate_price' => 7499.99,
                'commission_percentage' => 7.00,
                'bv' => 60,
                'images' => [
                    'https://via.placeholder.com/400x300/E83E8C/FFF?text=Ninja+Coffee',
                    'https://via.placeholder.com/400x300/E83E8C/FFF?text=Ninja+Coffee+2'
                ]
            ],

            // Cookware & Bakeware
            [
                'product_name' => 'Calphalon Non-Stick Cookware Set',
                'product_description' => '10-piece non-stick cookware set with hard-anodized aluminum construction. Includes pots, pans, and cooking utensils.',
                'subcategory_id' => $cookwareSubcategory->id,
                'sub_subcategory_id' => $nonStickCookware->id,
                'normal_price' => 16999.99,
                'quantity' => 15,
                'tags' => 'Calphalon, Non-stick, Cookware Set, 10 Piece, Hard-anodized',
                'is_affiliate' => true,
                'affiliate_price' => 15999.99,
                'commission_percentage' => 4.50,
                'bv' => 130,
                'images' => [
                    'https://via.placeholder.com/400x300/007BFF/FFF?text=Calphalon+Set',
                    'https://via.placeholder.com/400x300/007BFF/FFF?text=Calphalon+Set+2'
                ]
            ],
            [
                'product_name' => 'All-Clad Stainless Steel Cookware Set',
                'product_description' => 'Professional-grade stainless steel cookware with tri-ply construction. Even heating and durable construction for serious cooks.',
                'subcategory_id' => $cookwareSubcategory->id,
                'sub_subcategory_id' => $stainlessSteelCookware->id,
                'normal_price' => 35999.99,
                'quantity' => 8,
                'tags' => 'All-Clad, Stainless Steel, Tri-ply, Professional Grade',
                'is_affiliate' => false,
                'bv' => 280,
                'images' => [
                    'https://via.placeholder.com/400x300/868E96/FFF?text=All-Clad+Steel',
                    'https://via.placeholder.com/400x300/868E96/FFF?text=All-Clad+Steel+2'
                ]
            ],

            // Kitchen Tools & Gadgets
            [
                'product_name' => 'Wusthof Classic 8-Piece Knife Block Set',
                'product_description' => 'German-made knife set with precision-forged blades and ergonomic handles. Includes chef, paring, and utility knives.',
                'subcategory_id' => $kitchenToolsSubcategory->id,
                'sub_subcategory_id' => $knivesSet->id,
                'normal_price' => 25999.99,
                'quantity' => 10,
                'tags' => 'Wusthof, Knife Set, German Made, Precision Forged, 8 Piece',
                'is_affiliate' => true,
                'affiliate_price' => 23999.99,
                'commission_percentage' => 3.50,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/400x300/212529/FFF?text=Wusthof+Knives',
                    'https://via.placeholder.com/400x300/212529/FFF?text=Wusthof+Knives+2'
                ]
            ],
            [
                'product_name' => 'John Boos Maple Cutting Board',
                'product_description' => 'Premium end-grain maple cutting board that is gentle on knives. Reversible design with juice groove on one side.',
                'subcategory_id' => $kitchenToolsSubcategory->id,
                'sub_subcategory_id' => $cuttingBoard->id,
                'normal_price' => 4999.99,
                'quantity' => 25,
                'tags' => 'John Boos, Maple, Cutting Board, End Grain, Reversible',
                'is_affiliate' => true,
                'affiliate_price' => 4599.99,
                'commission_percentage' => 8.50,
                'bv' => 40,
                'images' => [
                    'https://via.placeholder.com/400x300/F8F9FA/000?text=John+Boos+Board',
                    'https://via.placeholder.com/400x300/F8F9FA/000?text=John+Boos+Board+2'
                ]
            ]
        ];

        foreach ($kitchenProducts as $productData) {
            // Generate unique product ID
            $productId = 'KA-' . strtoupper(Str::random(8));

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
                'category_id' => $kitchenCategory->id,
                'subcategory_id' => $productData['subcategory_id'],
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

            $this->command->info("Created Kitchen Appliance product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Kitchen Appliance products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Kitchen Appliances category');
        $this->command->info('- 6 subcategories (Cooking Appliances, Small Kitchen Appliances, Food Processors & Blenders, Coffee & Tea Makers, Cookware & Bakeware, Kitchen Tools & Gadgets)');
        $this->command->info('- 18 sub-subcategories');
        $this->command->info('- ' . count($kitchenProducts) . ' kitchen appliance products with images');
    }
}
