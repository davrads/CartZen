<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = User::where('role', UserRole::VENDOR)->get();
        $categories = Category::all();

        foreach ($vendors as $vendor) {

            for ($i = 1; $i <= 5; $i++) {

                Product::create([
                    'vendor_id' => $vendor->id,
                    'category_id' => $categories->random()->id,

                    'name' => "{$vendor->name} Product {$i}",
                    'slug' => Str::slug("{$vendor->name}-product-{$i}"),

                    'description' => "Sample description for {$vendor->name} Product {$i}",

                    'brand' => 'CartZen',

                    'sku' => strtoupper(Str::random(8)),

                    'price' => rand(1000, 10000),

                    'discounted_price' => rand(800, 9000),

                    'stock' => rand(10, 100),

                    'status' => 'available',

                    'thumbnail' => collect([
                        'products/thumbnails/sample1.jpg',
                        'products/thumbnails/sample2.jpg',
                        'products/thumbnails/sample3.jpg',
                    ])->random(),

                    'featured' => rand(0, 1),
                ]);
            }
        }
    }
}
