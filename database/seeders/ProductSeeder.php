<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing data
        Category::query()->delete();
        Subcategory::query()->delete();
        Brand::query()->delete();
        Product::query()->delete();

        // Reset auto-increment so IDs start from 1
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE subcategories AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE brands AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');

        $categories = [
            'Living Room' => [
                'slug' => 'living-room',
                'image' => 'demo-images/categories/living-room.jpg',
                'subcategories' => [
                    'Sofas & Couches',
                    'Coffee Tables',
                    'TV Stands',
                    'Recliners & Chairs',
                    'Rugs & Carpets',
                ],
                'brands' => ['ComfortHome', 'LuxeLiving', 'CozyNest'],
                'products' => [
                    'Black Sofa Set',
                    'Minimal Sofa',
                    'Pattern Tea Table',
                    'Modern TV Stand',
                    'Plush Area Rug'
                ]
            ],
            'Bedroom' => [
                'slug' => 'bedroom',
                'image' => 'demo-images/categories/bedroom.jpg',
                'subcategories' => [
                    'Beds',
                    'Wardrobes',
                    'Dressers',
                    'Nightstands',
                    'Bedding Sets',
                ],
                'brands' => ['SleepWell', 'DreamCraft', 'RestEase'],
                'products' => [
                    'Queen Size Wooden Bed',
                    'Sliding Door Wardrobe',
                    '6-Drawer Dresser',
                    'Classic Nightstand',
                    'Premium Cotton Bedding'
                ]
            ],
            'Kitchen' => [
                'slug' => 'kitchen',
                'image' => 'demo-images/categories/kitchen.jpg',
                'subcategories' => [
                    'Dining Tables',
                    'Chairs & Stools',
                    'Kitchen Cabinets',
                    'Cookware Sets',
                    'Storage & Organizers',
                ],
                'brands' => ['ChefMaster', 'KitchenLux', 'CookEase'],
                'products' => [
                    'Circle Dining Table',
                    'Bar Stool Set of 2',
                    'Modular Kitchen Cabinet',
                    'Stainless Steel Cookware Set',
                    'Multi-Layer Kitchen Rack'
                ]
            ],
            'Guest Room' => [
                'slug' => 'guest-room',
                'image' => 'demo-images/categories/guest-room.jpg',
                'subcategories' => [
                    'Sofa Beds',
                    'Accent Chairs',
                    'Side Tables',
                    'Wall Decor',
                    'Lamps & Lighting',
                ],
                'brands' => ['GuestComfort', 'Welcomia', 'CozyGuest'],
                'products' => [
                    'Convertible Sofa Bed',
                    'Velvet Accent Chair',
                    'Glass Top Side Table',
                    'Abstract Wall Art',
                    'Standing Floor Lamp'
                ]
            ],
        ];

        foreach ($categories as $catName => $catData) {
            // Insert Category
            $category = Category::create([
                'category_name' => $catName,
                'category_slug' => $catData['slug'],
                'category_img' => null,
                'status' => 1,
                'showHome' => 1,
            ]);

            // Insert Subcategories
            $subcategoryIds = [];
            foreach ($catData['subcategories'] as $subName) {
                $subcategory = Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'status' => 1,
                    'showHome' => 1,
                ]);
                $subcategoryIds[] = $subcategory->id;
            }

            // Insert Brands
            $brandIds = [];
            foreach ($catData['brands'] as $brandName) {
                $brand = Brand::create([
                    'name' => $brandName,
                    'slug' => Str::slug($brandName),
                    'status' => 1,
                ]);
                $brandIds[] = $brand->id;
            }

            // Insert Products
            foreach ($catData['products'] as $productName) {
                $product = Product::create([
                    'title' => $productName,
                    'slug' => Str::slug($productName) . '-' . Str::random(5),
                    'short_description' => "
                        - Stylish & durable.  
                        - Fits any decor.  
                        - Easy to maintain.
                    ",
                    'description' => "
                        - Crafted from premium materials for long-lasting durability.  
                        - Timeless design suitable for modern and traditional interiors.  
                        - Lightweight yet sturdy for easy movement.  
                        - Smooth finish adds elegance to your space.  
                        - Resistant to everyday wear and tear.  
                        - Easy-to-clean surface, just wipe with a soft cloth.  
                        - Perfect for homes, offices, and guest rooms.  
                        - Combines aesthetic appeal with functional design.
                    ",
                    'shipping_returns' => "
                        - Free nationwide delivery.  
                        - Estimated delivery in 3–5 business days.  
                        - 10-day hassle-free returns.  
                        - Full refund if returned unused in original packaging.  
                        - Secure packaging to prevent damage in transit.  
                        - Customer support for order tracking & assistance.  
                        - Returns processed within 48 hours of inspection.  
                        - Replacement for damaged or defective products available.
                    ",
                    'price' => rand(100, 1000),
                    'category_id' => $category->id,
                    'subcategory_id' => $subcategoryIds[array_rand($subcategoryIds)],
                    'brand_id' => $brandIds[array_rand($brandIds)],
                    'sku' => strtoupper(Str::random(8)),
                    'barcode' => 'BC' . rand(100000, 999999),
                    'qty' => rand(1, 50),
                    'status' => 1,
                ]);

                $product->related_products = '';
                $product->save();
            }
        }

        // Assign related products
        $allProducts = Product::all();
        foreach ($allProducts as $product) {
            $related = $allProducts->where('category_id', $product->category_id)
                                   ->where('id', '!=', $product->id)
                                   ->pluck('id')
                                   ->shuffle()
                                   ->take(3)
                                   ->toArray();
            $product->related_products = implode(',', $related);
            $product->save();
        }
    }
}
