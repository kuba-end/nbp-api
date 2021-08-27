<?php

namespace App\Controller;

use App\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatesController extends AbstractController
{
    /**
     * @Route( "/rates", name = "rates")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $currency = $em->getRepository(Currency::class)->findAll();
        return $this->render('rates/index.html.twig' ,[
            'allCurrencies' => $currency
        ]);
    }
}
