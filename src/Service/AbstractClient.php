<?php

namespace App\Service;

use App\Entity\Currency;
use GuzzleHttp\Client as HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    public function serializer($response): object
    {
        $response = $response->getBody();
        echo $response;
        $encoder = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers,$encoder);

        return $serializer->deserialize($response, Currency::class,'json');
    }
}