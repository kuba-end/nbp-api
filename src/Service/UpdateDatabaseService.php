<?php

namespace App\Service;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateDatabaseService extends AbstractController
{
    public $entityManager;
    public $entityCurrency;

    public function __construct(EntityManagerInterface $entityManager)
    {
     $this->entityManager = $entityManager;
    }

    public function updateDb(ProcessDataService $data)
    {
        $codes = $data->currencyCodes;
        $names = $data->currencyNames;
        $rates = $data->currencyRates;
        $batchSize=count($codes);
        $em = $this->entityManager;


        for ($i=0;$i <= $batchSize-1;$i++)
        {
            $this->entityCurrency = new Currency();
            $code = $codes[$i];
            $name = $names[$i];
            $rate = $rates[$i];
            $amount = $rates[$i];
            $this->entityCurrency->setCurrencyCode($code);
            $this->entityCurrency->setName($name);
            $this->entityCurrency->setExchangeRate($rate);
            $this->entityCurrency->setAmount($amount);
            $em->persist($this->entityCurrency);
            $em->flush();
        }
    }
}