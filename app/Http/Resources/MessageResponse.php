<?php

namespace App\Http\Resources;

class MessageResponse extends DataResponse
{
    public function response($request = null): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->with($request), parent::response()->getStatusCode());
    }

    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'message' => $this->resource['message'] ?? null,
        ];
    }

    public function with($request)
    {
        return [
            'message' => $this->resource['message'] ?? null,
        ];
    }
}
