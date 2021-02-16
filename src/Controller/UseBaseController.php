<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UseBaseController extends AbstractController
{
    /**
     * @Route("/base", name="use_base")
     */
    public function index(): Response
    {
        
        return $this->render('use_base/index.html.twig', [
            'controller_name' => 'UseBaseController',
        ]);
    }
}
