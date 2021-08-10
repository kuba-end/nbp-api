<?php

namespace App\Command;

use App\Service\DecodeResponseService;
use App\Service\NbpClient;
use App\Service\ProcessDataService;
use App\Service\UpdateDatabaseService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

class UpdateCommand extends AbstractCommand
{
    protected static $defaultName = "nbp-api:update";
    public $em;



    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($name = null);
        $this->em=$em;
    }

    public function handle()
    {
        $firstParam = 'tables';
        $secondParam = 'A';

        $run = new ProcessDataService(new NbpClient());
        $run->getAllCurrenciesData($firstParam,$secondParam);
        $updateCurrency = new UpdateDatabaseService($this->em);
        $updateCurrency->updateDb($run);
        return self::SUCCESS;
    }


}