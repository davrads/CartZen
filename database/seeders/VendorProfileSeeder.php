<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VendorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = User::where('role', 'vendor')->get();

        foreach ($vendors as $vendor) {
            VendorProfile::create([
                'user_id' => $vendor->id,
                'shop_name' => $vendor->name,
                'shop_slug' => Str::slug($vendor->name),
                'description' => "Official shop of {$vendor->name}",
                'phone' => '98' . rand(10000000, 99999999),
                'address' => 'Kathmandu, Nepal',
                'pan_number' => 'PAN' . rand(10000, 99999),
                'account_number' => 'ACC' . rand(100000, 999999),
                'status' => 'approved',
            ]);
        }
    }
}
