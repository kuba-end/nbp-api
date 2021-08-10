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

    public function updateDb()
    {
        $em = $this->entityManager;
        $this->entityCurrency->setName('test');
        $this->entityCurrency->setCurrencyCode('test');
        $this->entityCurrency->setExchangeRate(1);
        $this->entityCurrency->setAmount(1);
    }
}