<?php

namespace App\Service;

use App\Command\AbstractCommand;

class ProcessDataService
{
    private $response;
    public array $currencyNames = [];
    public array $currencyCodes = [];
    public array $currencyRates = [];
    public string $currencyTables;

    /**
     * @param $response
     * This class is called in App\Command\UpdateCommand and as a param for __construct method
     * App\Service\NbpClient is passed
     */
    public function __construct($response)
    {
        $this->response=$response;
    }

    /**
     * @param $firstParam
     * @param $secondParam
     *
     * Hard typed params only for task, in future there will be many options available
     * to get all data from nbp api
     *
     * Method could be use in App\Command\UpdateCommand for took all datas from tables
     * from nbp-api
     */
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
            $this->currencyTables=$secondParam;
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
    public function getCurrencyTable():string
    {
        return $this->currencyTables;
    }

}