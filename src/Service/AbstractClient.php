<?php

namespace App\Service;

use GuzzleHttp\Client as HttpClient;

abstract class AbstractClient
{
    protected $client;

    public function __construct(DecodeResponseService $body)
    {
        $this->client = new HttpClient();
        return $body;
    }
}