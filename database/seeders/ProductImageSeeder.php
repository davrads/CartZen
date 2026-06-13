<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iphone = Product::where('slug', 'iphone-13')->first();
        ProductImage::create([
            'product_id' => $iphone->id,
            'product_image' => 'product_images/v1.jpg'
        ]);
        ProductImage::create([
            'product_id' => $iphone->id,
            'product_image' => 'product_images/v2.jpg'
        ]);
        ProductImage::create([
            'product_id' => $iphone->id,
            'product_image' => 'product_images/v3.jpg'
        ]);
        ProductImage::create([
            'product_id' => $iphone->id,
            'product_image' => 'product_images/v4.jpg'
        ]);

        $football = Product::where('slug', 'football')->first();
        ProductImage::create([
            'product_id' => $football->id,
            'product_image' => 'product_images/f1.jpg'
        ]);
        ProductImage::create([
            'product_id' => $football->id,
            'product_image' => 'product_images/f2.jpg'
        ]);
        ProductImage::create([
            'product_id' => $football->id,
            'product_image' => 'product_images/f3.jpg'
        ]);
        ProductImage::create([
            'product_id' => $football->id,
            'product_image' => 'product_images/f4.jpg'
        ]);
    }
}
