<?php

namespace App\Http\Controllers;

use App\Services\ApiClientService;
use Illuminate\Http\Request;

class ApiClientController extends Controller
{
    public function __construct(protected ApiClientService $apiClientService)
    {
    }

    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:api_clients,name',
        ]);

        $apiClient = $this->apiClientService->createApiClient($request->all());

        return response()->json([
            'status' => true,
            'message' => 'API client created successfully',
            'data' => [
                'access_key' => $apiClient->access_key,
                'expires_at' => $apiClient->expires_at,
            ],
        ]);
    }
}
