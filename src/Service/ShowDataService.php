<?php

namespace App\Service;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class ShowDataService
{
    public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    private function getData()
    {
        $all = $this->em->getRepository(Currency::class)->findAll();
        $this->showData($all);
    }
    public function showData($data)
    {
        foreach ($data as $single)
        {
            return $single;
        }
    }
}