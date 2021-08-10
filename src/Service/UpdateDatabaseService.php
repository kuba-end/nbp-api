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
     $this->entityCurrency = new Currency();
    }

    public function updateDb(ProcessDataService $data)
    {
        $codes = $data->currencyCodes;
        $names = $data->currencyNames;
        $rates = $data->currencyRates;
        $em = $this->entityManager;
        foreach ($codes as $code)
        {
            $this->entityCurrency->setCurrencyCode($code);
            $em->persist($this->entityCurrency);
        }
        foreach ($names as $name)
        {
            $this->entityCurrency->setName($name);
            $em->persist($this->entityCurrency);
        }
        foreach ($rates as $rate)
        {
            $this->entityCurrency->setExchangeRate($rate);
            $em->persist($this->entityCurrency);
        }
        foreach ($rates as $rate)
        {
            $this->entityCurrency->setAmount($rate);
            $em->persist($this->entityCurrency);
        }
        $em->flush();
    }
}