<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeControleurController extends AbstractController
{

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
       $this->user = $security->getUser();

    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeControleurController',
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(): Response
    {
        return $this->render('home/mentions.html.twig', [
            'controller_name' => 'HomeControleurController',
        ]);
    }
}
