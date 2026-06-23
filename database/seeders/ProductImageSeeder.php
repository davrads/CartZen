<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            ProductImage::create([
                'product_id' => $product->id,
                'product_image' => 'products/gallery/sample1.jpg',
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'product_image' => 'products/gallery/sample2.jpg',
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'product_image' => 'products/gallery/sample3.jpg',
            ]);
        }
    }
}