<?php

namespace App\Services;

use App\Models\User;
use App\Services\Factory\UserFactory;
use Illuminate\Support\Facades\Hash;

class UserRegistrationService
{
    private UserFactory $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function register(array $userData): User
    {
        $userData['password'] = Hash::make($userData['password']);

        return $this->userFactory->create($userData);
    }
}
