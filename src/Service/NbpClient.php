<?php

namespace App\Service;


class NbpClient extends AbstractClient
{
    const NBP_URI="http://api.nbp.pl/api";

    public function request($goal, $specific)
    {
        $method="GET";
        $exchangeRates = "/exchangerates";
        $goal = "/".$goal;
        $specific = "/".$specific;
        $uri = self::NBP_URI.$exchangeRates.$goal.$specific;

        return $this->client->request($method,$uri);
    }
}