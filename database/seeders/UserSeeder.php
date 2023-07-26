<?php

namespace Database\Seeders;

use App\Models\User;
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
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@rest-api-lumen.example',
            'password' => Hash::make('password'),
            'phone' => '1234567890',
        ]);

        User::create([
            'first_name' => 'Michael',
            'last_name' => 'Johnson',
            'email' => 'michael.johnson@example.com',
            'password' => Hash::make('securepass123'),
            'phone' => '5555555555',
        ]);
    }
}
