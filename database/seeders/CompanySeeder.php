<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $user = User::get()->last();

        Company::create([
            'title' => 'Company A',
            'phone' => '1234567890',
            'description' => 'This is Company A description.',
            'user_id' => $user->id,
        ]);

        Company::create([
            'title' => 'Company B',
            'phone' => '9876543210',
            'description' => 'This is Company B description.',
            'user_id' => $user->id,
        ]);
    }
}
