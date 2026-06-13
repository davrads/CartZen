<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);

        User::create([
            'name' => 'Fashion Store',
            'email' => 'fashion@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
        ]);

        User::create([
            'name' => 'Sports Store',
            'email' => 'sports@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
        ]);

        User::create([
            'name' => 'Home Store',
            'email' => 'home@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
        ]);

        User::create([
            'name' => 'Books Store',
            'email' => 'books@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
        ]);

        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@cartzen.com',
            'password' => Hash::make('password'),
            'role' => UserRole::CUSTOMER,
        ]);
    }
}
