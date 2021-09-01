<?php

namespace App\Service;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateDatabaseService extends AbstractController
{
    public $entityManager;
    public $entityCurrency;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
     $this->entityManager = $entityManager;
    }

    /**
     * @param ProcessDataService $data
     *
     * Core method, iterate over the array for pick currency codes, names and rates.
     * If rate<0.5 amount of currency is set to 1000 and rate is multiplied times 1000,
     * rates less than 10 and bigger than 0 are multiplied times 10 and amount is set to 10
     */
    public function updateDb(ProcessDataService $data, string $table)
    {
        $codes = $data->currencyCodes;
        $names = $data->currencyNames;
        $rates = $data->currencyRates;
        $grosze = $data->currencyRatesGrosze;
        $batchSize=count($codes);
        $em = $this->entityManager;



        for ($i=0;$i <= $batchSize-1;$i++)
        {
            $amount = 1;
            $code = $codes[$i];
            $name = $names[$i];
            $rate = $rates[$i];
            $grosz = $grosze[$i];

            if ( ! $em->getRepository(Currency::class)->findBy(
                [
                    'currency_code' => $code
                ]
            )) {
                if ($rate < 0.1 && $rate > 0.01)
                {
                    $amount = 100;
                    $grosz = $grosz * 100;
                    $this->entityCurrency = new Currency();
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate(round($grosz));
                    $this->entityCurrency->setAmount($amount);
                    $this->entityCurrency->setTablee($table);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }
                elseif ($rate <= 0.01)
                {
                    $amount=1000;
                    $grosz=$grosz*1000;
                    $this->entityCurrency = new Currency();
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate(round($grosz));
                    $this->entityCurrency->setAmount($amount);
                    $this->entityCurrency->setTablee($table);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }elseif ($rate <= 0.0001)
                {
                    $amount=100000;
                    $grosz=$grosz*100000;
                    $this->entityCurrency = new Currency();
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate(round($grosz));
                    $this->entityCurrency->setAmount($amount);
                    $this->entityCurrency->setTablee($table);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }else{
                    $this->entityCurrency = new Currency();
                    $this->entityCurrency->setCurrencyCode($code);
                    $this->entityCurrency->setName($name);
                    $this->entityCurrency->setExchangeRate(round($grosz));
                    $this->entityCurrency->setAmount($amount);
                    $this->entityCurrency->setTablee($table);
                    $em->persist($this->entityCurrency);
                    $em->flush();
                }
            }
            else
            {
                $record = $em->getRepository(Currency::class)->findOneBy(
                    [
                    'currency_code' => $code
                    ]
                );
                if ($rate < 0.1 && $rate > 0.01) {
                    $grosz = $grosz * 100;
                    $record->setExchangeRate(round($grosz));
                    $em->flush();
                }
                elseif ($rate <= 0.01 && $rate > 0.0001) {
                    $grosz = $grosz * 1000;
                    $record->setExchangeRate(round($grosz));
                    $em->flush();
                }
                elseif ($rate <= 0.0001) {
                    $grosz = $grosz * 100000;
                    $record->setExchangeRate(round($grosz));
                    $em->flush();
                }else{
                    $record->setExchangeRate(round($grosz));
                    $em->flush();
                }
            }
        }
    }
}