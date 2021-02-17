<?php

namespace App\Controller;

use App\Entity\Apprenant;
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
        //on appelle tout la liste des apprenant
        $apprenants =$this->getDoctrine()->getRepository(Apprenant::class)->findAll();
        
        
        return $this->render('use_base/index.html.twig', [
            'apprenants' => $apprenants,
        ]);
    }
}
