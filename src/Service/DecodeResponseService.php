<?php

namespace App\Service;

class DecodeResponseService
{
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