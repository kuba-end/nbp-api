<?php

namespace App\Service;

use GuzzleHttp\Client as HttpClient;

abstract class AbstractClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new HttpClient();
    }
    public function decode($response): array
    {
        $body = json_decode($response->getBody(),true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            throw new \http\Exception\RuntimeException
            (
                sprintf("Cannot decode response")
            );
        }
        return $body;
    }
}