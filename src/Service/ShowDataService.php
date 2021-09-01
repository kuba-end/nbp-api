<?php

namespace App\Service;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class ShowDataService
{
    const TABLE = ['A','B'];
    public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getData(array $currency)
    {
        foreach ($currency as $data)
        {
            return [$data->getName(),
            $data->getCurrencyCode(),
            $data->getExchangeRate(),
            $data->getAmount(),
            $data->getTablee()];
        }
    }
    public function showData($data)
    {
        foreach ($data as $single)
        {
             var_dump($single);
        }
    }
}