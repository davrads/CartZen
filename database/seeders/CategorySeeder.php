<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics =Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'image'=> null,
        ]);
        $fashion =Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
            'image'=> null,
        ]);
        $homeandliving =Category::create([
            'name' => 'Home & Living',
            'slug' => 'home&living',
            'image'=> null,
        ]);
        $babytoy =Category::create([
            'name' => 'Baby & Toys',
            'slug' => 'baby&toys',
            'image'=> null,
        ]);
        $sports =Category::create([
            'name' => 'Sports',
            'slug' => 'sports',
            'image'=> null,
        ]);
        $health =Category::create([
            'name' => 'Health',
            'slug' => 'health',
            'image'=> null,
        ]);
        $automotive =Category::create([
            'name' => 'Automotive',
            'slug' => 'automotive',
            'image'=> null,
        ]);
        $books =Category::create([
            'name' => 'Books',
            'slug' => 'books',
            'image'=> null,
        ]);
    }
}
