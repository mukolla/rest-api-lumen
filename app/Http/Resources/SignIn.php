<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class SignIn extends DataResponse
{
    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this->resource,
            'token_type' => 'bearer',
            'user' => auth()->user(),
            'expires_in' => auth()->factory()->getTTL() * 60 * 24,
        ];
    }
}
