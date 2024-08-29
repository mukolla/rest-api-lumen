<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\Factory\UserFactory;
use App\Services\UserRegistrationService;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class UserRegistrationServiceTest extends TestCase
{
    private UserRegistrationService $service;

    private MockObject|UserFactory $userFactoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        Facade::clearResolvedInstance(Hash::class);
        Hash::shouldReceive('make')->andReturn('hashed_password');

        $this->userFactoryMock = $this->createMock(UserFactory::class);

        $this->service = new UserRegistrationService($this->userFactoryMock);
    }

    public function testRegister(): void
    {
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'super123',
            'phone' => '+123456789',
        ];

        $userDataWithHashedPassword = $userData;
        $userDataWithHashedPassword['password'] = 'hashed_password';

        $user = new User($userDataWithHashedPassword);

        $this->userFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with($userDataWithHashedPassword)
            ->willReturn($user);

        $result = $this->service->register($userData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertSame($user, $result);
    }
}
