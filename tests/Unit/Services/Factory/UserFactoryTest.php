<?php

namespace Tests\Unit\Services\Factory;

use App\Models\User;
use App\Services\Factory\UserFactory;
use Mockery;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class UserFactoryTest extends TestCase
{
    private UserFactory $service;

    private User|Mockery\MockInterface $userMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userMock = \Mockery::mock(User::class);
        $this->service = new UserFactory($this->userMock);
    }

    /**
     * @throws Exception
     */
    public function testCreate(): void
    {
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'hashed_password',
            'phone' => '+123456789',
        ];

        $this->userMock
            ->shouldReceive('create')
            ->with($userData)
            ->andReturn(new User($userData));

        $user = $this->service->create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('Doe', $user->last_name);
        $this->assertEquals('johndoe@example.com', $user->email);
    }
}
