<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = User::where('role', 'vendor')->first();

        VendorProfile::create([
            'user_id' => $vendor->id,
            'shop_name' => 'Tech Nepal',
            'shop_slug' => 'tech-nepal',
            'shop_logo' => 'shops/tech-nepal.png',
            'description' => 'Electronics and gadgets store.',
            'phone' => '9800000001',
            'address' => 'Kathmandu',
            'pan_number' => 'PAN1001',
            'account_number' => 'ACC1001',
            'status' => 'approved',
        ]);
         VendorProfile::create([
            'user_id' => $vendor->id,
            'shop_name' => 'Fashion Hub',
            'shop_slug' => 'fashion-hub',
            'shop_logo' => 'shops/fashion-hub.png',
            'description' => 'Fashion and clothing products.',
            'phone' => '9800000002',
            'address' => 'Pokhara',
            'pan_number' => 'PAN1002',
            'account_number' => 'ACC1002',
            'status' => 'approved',
        ]);

        VendorProfile::create([
            'user_id' => $vendor->id,
            'shop_name' => 'Sports World',
            'shop_slug' => 'sports-world',
            'shop_logo' => 'shops/sports-world.png',
            'description' => 'Sports equipment and accessories.',
            'phone' => '9800000003',
            'address' => 'Butwal',
            'pan_number' => 'PAN1003',
            'account_number' => 'ACC1003',
            'status' => 'approved',
        ]);

        VendorProfile::create([
            'user_id' => $vendor->id,
            'shop_name' => 'Home Essentials',
            'shop_slug' => 'home-essentials',
            'shop_logo' => 'shops/home-essentials.png',
            'description' => 'Furniture and home appliances.',
            'phone' => '9800000004',
            'address' => 'Lalitpur',
            'pan_number' => 'PAN1004',
            'account_number' => 'ACC1004',
            'status' => 'pending',
        ]);
    }
}
