<?php

namespace App\Repository\interface;

interface ApiClientInterface
{
    public function create(array $data);
    public function getByAccessKey(string $accessKey);
}
