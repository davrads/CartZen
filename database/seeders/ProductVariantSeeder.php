<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iphone = Product::where('slug', 'iphone-13')->first();
        ProductVariant::create([
            'product_id' => $iphone->id,
            'color' => 'black',
            'size' => '256gb',
            'stock' => 10,
            'price' => 100000
        ]);

        ProductVariant::create([
            'product_id' => $iphone->id,
            'color' => 'blue',
            'size' => '512gb',
            'stock' => 15,
            'price' => 120000
        ]);

        $football = Product::where('slug', 'football')->first();
        ProductVariant::create([
            'product_id' => $football->id,
            'color' => 'red',
            'size' => '5',
            'stock' => 5,
            'price' => 10000
        ]);

        ProductVariant::create([
            'product_id' => $football->id,
            'color' => 'black',
            'size' => '6',
            'stock' => 10,
            'price' => 12000
        ]);
    }
}
