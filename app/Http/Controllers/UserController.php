<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Services\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserFactory $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'phone' => 'required|string',
        ]);

        $userData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
        ];

        $user = $this->userFactory->create($userData);

        return (new UserResource($user))
            ->additional(['message' => 'Successfully registered user!'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
