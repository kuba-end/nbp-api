<?php

namespace App\Command;

use App\Service\DecodeResponseService;
use App\Service\NbpClient;
use App\Service\ProcessDataService;

class UpdateCommand extends AbstractCommand
{
    protected static $defaultName = "nbp-api:update";

    public function handle()
    {
        $firstParam = 'tables';
        $secondParam = 'A';

        $run = new ProcessDataService(new NbpClient());
        $run->getAllCurrenciesData($firstParam,$secondParam);

        return self::SUCCESS;
    }


}