<?php

namespace App\Services;

use App\Models\User;

class UserFactory
{
    public function create(array $userData): User
    {
        return User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'phone' => $userData['phone'],
        ]);
    }
}
