<?php

namespace App\Services\Factory;

use App\Models\User;

class UserFactory
{
    public function __construct(private readonly User $user)
    {
    }

    public function create(array $userData): User
    {
        return $this->user::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'phone' => $userData['phone'],
        ]);
    }
}
