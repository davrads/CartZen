<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            ProductVariant::create([
                'product_id' => $product->id,
                'color' => 'Black',
                'size' => 'Small',
                'stock' => 10,
                'price' => $product->price,
            ]);

            ProductVariant::create([
                'product_id' => $product->id,
                'color' => 'Blue',
                'size' => 'Medium',
                'stock' => 8,
                'price' => $product->price + 200,
            ]);

            ProductVariant::create([
                'product_id' => $product->id,
                'color' => 'Red',
                'size' => 'Large',
                'stock' => 5,
                'price' => $product->price + 500,
            ]);
        }
    }
}