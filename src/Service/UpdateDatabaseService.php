<?php

namespace App\Service;

use App\Entity\Currency;
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
            $code = $codes[$i];
            $name = $names[$i];
            $rate = $rates[$i];
            if (! $em->getRepository(Currency::class)->findBy(
                [
                    'currency_code' => $code
                ]
            )) {
                $this->entityCurrency = new Currency();
                $amount = 1;
                if ($rate<0.5){
                    $amount=1000;
                    $rate=$rate*1000;
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate($rate);
                    $this->entityCurrency->setAmount($amount);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }
                elseif (10>$rate && $rate>0)
                {
                    $amount=10;
                    $rate=$rate*10;
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate($rate);
                    $this->entityCurrency->setAmount($amount);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }
                else{
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate($rate);
                    $this->entityCurrency->setAmount($amount);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }

            }else
            {
                $record = $em->getRepository(Currency::class)->findOneBy(
                    [
                    'currency_code' => $code
                    ]
                );
                $record->setExchangeRate($rate);
                $em->flush();
            }
        }
    }
}