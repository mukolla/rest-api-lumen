<?php

namespace App\Http\Controllers;

use App\Http\Resources\BadRequestResponse;
use App\Http\Resources\MessageResponse;
use App\Http\Resources\SignIn;
use App\Http\Resources\SuccessResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     */
    public function signIn(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        $token = Auth::attempt($credentials);

        if ($token === false) {
            return (new MessageResponse(['message' => 'Invalid credentials']))
                ->response()
                ->setStatusCode(Response::HTTP_PAYMENT_REQUIRED);
        }

        return (new SignIn($token))->response();
    }

    /**
     * @throws ValidationException
     */
    public function recoverPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|string|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return (new SuccessResponse(['message' => 'Password reset link sent!']))
                ->response();
        }

        return (new BadRequestResponse(['message' => 'Unable to send reset link. Please try again later.']))
            ->response();
    }

    /**
     * @throws ValidationException
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return (new SuccessResponse(['message' => 'Password reset successfully!']))
                ->response();
        }

        return (new BadRequestResponse(['message' => 'Unable to reset password. Please try again later.']))
            ->response();
    }
}
