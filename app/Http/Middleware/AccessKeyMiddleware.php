<?php

namespace App\Http\Middleware;

use App\Repository\ApiClientRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AccessKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessKey = $request->header('accessKey');
        if (!$accessKey) {
            return response()->json([
                'status' => false,
                'message' => 'Access key is required',
            ], 401);
        }

        $repo = app()->make(ApiClientRepository::class);
        $apiClient = $repo->getByAccessKey($accessKey);
        if (!$apiClient) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid access key',
            ], 401);
        }

        if ($apiClient->expires_at && $apiClient->expires_at->isPast()) {
            return response()->json([
                'status' => false,
                'message' => 'Access key expired',
            ], 401);
        }

        return $next($request);
    }
}
