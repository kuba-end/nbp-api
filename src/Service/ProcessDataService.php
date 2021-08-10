<?php

namespace App\Service;

class ProcessDataService
{
    private $response;

    public function __construct($response)
    {
        $this->response=$response;
    }

    public function getAllCurrenciesData($firstParam, $secondParam)
    {
        $response = $this->response->request($firstParam,$secondParam);

        $currencyNames = [];
        $currencyCodes = [];
        $currencyRates = [];

        foreach ($response[0]['rates'] as $single)
        {
            $currencyNames[]=$single['currency'];
            $currencyCodes[]=$single['code'];
            $currencyRates[]=$single['mid'];
        }
    }
}