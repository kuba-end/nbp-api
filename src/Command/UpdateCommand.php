<?php

namespace App\Command;

use App\Form\TableFormType;
use App\Service\CreateTableForm;
use App\Service\NbpClient;
use App\Service\ProcessDataService;
use App\Service\UpdateDatabaseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class UpdateCommand extends AbstractCommand
{
    protected static $defaultName = "nbp-api:update";
    public $em;
    public $request;


    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($name = null);
        $this->em=$em;
    }

    /**
     *
     */
    public function handle(string $form)
    {
        $firstParam = 'tables';
        $secondParam = ['A','B'];
        if ($form == 'table_A')
        {
            $secondParam = $secondParam[0];
        }elseif($form == 'table_B')
        {
            $secondParam = $secondParam[1];
        }
        $run = new ProcessDataService(new NbpClient());
        $run->getAllCurrenciesData($firstParam,$secondParam);
        $updateCurrency = new UpdateDatabaseService($this->em);
        $updateCurrency->updateDb($run,$secondParam);
        return self::SUCCESS;
    }


}