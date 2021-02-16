<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeControleurController extends AbstractController
{
    /**
     * @Route("/", name="home_controleur")
     */
    public function index(): Response
    {
        return $this->render('home_controleur/index.html.twig', [
            'controller_name' => 'HomeControleurController',
        ]);
    }
}
