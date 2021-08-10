<?php

namespace App\Service;

class ProcessDataService
{
    private $response;
    public array $currencyNames = [];
    public array $currencyCodes = [];
    public array $currencyRates = [];

    public function __construct($response)
    {
        $this->response=$response;
    }

    public function getAllCurrenciesData($firstParam, $secondParam)
    {
        $response = $this->response->request($firstParam,$secondParam);





        foreach ($response[0]['rates'] as $single)
        {
            $this->currencyNames[]=$single['currency'];
            $this->currencyCodes[]=$single['code'];
            $rate=round($single['mid'],6);
            $grosze = $rate * 100;
            $this->currencyRates[]=$grosze;
        }

    }

    /**
     * @return array
     */
    public function getCurrencyRates(): array
    {
        return $this->currencyRates;
    }

    /**
     * @return array
     */
    public function getCurrencyNames(): array
    {
        return $this->currencyNames;
    }

    /**
     * @return array
     */
    public function getCurrencyCodes(): array
    {
        return $this->currencyCodes;
    }

}