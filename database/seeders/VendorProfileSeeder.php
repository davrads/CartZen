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
         $vendors = User::take(3)->get();

        foreach ($vendors as $vendor) {
            VendorProfile::create([
                'user_id' => $vendor->id,
                'shop_name' => $vendor->name . "'s Store",
                'shop_slug' => strtolower(str_replace(' ', '-', $vendor->name)) . '-store',
                'description' => 'Demo vendor store',
                'phone' => '9800000000',
                'address' => 'Kathmandu',
                'pan_number' => 'PAN-' . $vendor->id,
                'account_number' => 'ACC-' . $vendor->id,
                'status' => 'approved',
            ]);
        }
    }
}
