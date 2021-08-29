<?php

namespace App\Controller;

use App\Command\UpdateCommand;
use App\Entity\Currency;
use App\Form\TableFormType;
use App\Service\ShowDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatesController extends AbstractController
{
    /**
     * @Route( "/rates", name = "rates")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, EntityManagerInterface $emi)
    {
        $em = $this->getDoctrine()->getManager();
        $currency = null;
        $form = $this->createForm(TableFormType::class);
        $form->handleRequest($request);

        if ($form->get('table_A')->isClicked())
        {
            $tableName = $form->get('table_A')->getName();
            $table = 'A';
            $check = new UpdateCommand($emi);
            $check->handle($tableName);
            $currency = $em->getRepository(Currency::class)->findTable($table);

        }elseif ($form->get('table_B')->isClicked())
        {
            $tableName = $form->get('table_B')->getName();
            $table = 'B';
            $check = new UpdateCommand($emi);
            $check->handle($tableName);
            $currency = $em->getRepository(Currency::class)->findTable($table);
        }
        return $this->render('rates/index.html.twig' ,[
            'allCurrencies' => $currency,
            'tableForm' => $form->createView(),
        ]);
    }
}
