<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * class ApprenantControlllerController
 * @package App\Controller
 * @route("/apprenant", name="apprenant_")
 */
class ApprenantControlllerController extends AbstractController
{
    /**
     * @Route("/", name="candidature")
     */
    public function index(): Response
    {
        return $this->render('apprenant_controlller/index.html.twig', [
            'controller_name' => 'ApprenantControlllerController',
        ]);
    }
}
