<?php

namespace App\Controller;

use App\Utility\GetAllEntities;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param LoggerInterface $dbLogger
     * @return Response
     */
    public function home(LoggerInterface $dbLogger):Response
    {
        $dbLogger->info("Notre 1ere log");

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index():Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
