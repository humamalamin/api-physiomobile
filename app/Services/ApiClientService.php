<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ApiClientService
{
    protected $apiClientRepository;

    public function __construct(\App\Repository\interface\ApiClientInterface $apiClientRepository)
    {
        $this->apiClientRepository = $apiClientRepository;
    }

    public function createApiClient(array $data)
    {
        $accessKey = Str::random(40);

        $dataRequest = [
            'name' => $data['name'],
            'access_key' => $accessKey,
            'expires_at' => Carbon::now()->addDays(30),
        ];
        return $this->apiClientRepository->create($dataRequest);
    }
}
