<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Services\UserRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function register(Request $request, UserRegistrationService $userRegistrationService): JsonResponse
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'phone' => 'required|string',
        ]);

        $userData = $request->only(['first_name', 'last_name', 'email', 'password', 'phone']);

        $user = $userRegistrationService->register($userData);

        return (new UserResource($user))
            ->additional(['message' => 'Successfully registered user!'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
