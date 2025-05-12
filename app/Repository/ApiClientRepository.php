<?php

namespace App\Repository;

use App\Models\ApiClient;

class ApiClientRepository implements \App\Repository\interface\ApiClientInterface
{
    private $model;

    public function __construct(ApiClient $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function getByAccessKey(string $accessKey)
    {
        return $this->model->where('access_key', $accessKey)->first();
    }
}
