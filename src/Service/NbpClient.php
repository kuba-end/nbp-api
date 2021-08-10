<?php

namespace App\Service;


class NbpClient extends AbstractClient
{
    const NBP_URI="http://api.nbp.pl/api";

    public function request($firstParam, $secondParam)
    {
        $method="GET";
        $exchangeRates = "/exchangerates";
        $firstParam = "/".$firstParam;
        $secondParam = "/".$secondParam;
        $uri = self::NBP_URI.$exchangeRates.$firstParam.$secondParam;

        return $this->client->request($method,$uri);
    }
}