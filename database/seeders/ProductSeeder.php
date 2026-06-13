<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = User::where('role', 'vendor')->first();
       $category =Category::where('slug','electronics')->first();
      
       Product::create([
        'vendor_id' => $vendor->id,
        'category_id' => $category->id,
        'name' => 'iphone 13',
        'slug' => 'iphone-13',
        'description' => 'A smart phone',
        'brand' => 'apple',
        'sku' => 'A123',
        'price' => 100000,
        'discounted_price' => 90000,
        'stock' => 10,
        'thumbnail' => 'products/iphone-13.jpg',
        'status' => 'available',
        'featured' => true
       ]);
        $category =Category::where('slug','sports')->first();
      
       Product::create([
        'vendor_id' => $vendor->id,
        'category_id' => $category->id,
        'name' => 'football',
        'slug' => 'football',
        'description' => 'A Professional football',
        'brand' => 'ABCD',
        'sku' => 'A123',
        'price' => 15000,
        'discounted_price' => 10000,
        'stock' => 10,
        'thumbnail' => 'products/football.jpg',
        'status' => 'available',
        'featured' => true
       ]);
            
         
    }
}
