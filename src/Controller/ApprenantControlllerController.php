<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\ApprenantFromType;
use App\Repository\ApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        //formulailaire
        
        return $this->render('apprenant_controlller/index.html.twig', [
            'controller_name' => 'ApprenantControlllerController',
            
        ]);
    }
    /**
    * @Route("home/administration/{id}", name="admin")
    */
    public function new(Request $request,ApprenantRepository $ApprenantRepository){
        $projects= new Apprenant();
        $form =$this->createForm(ApprenantFromType::class,$projects);
        $form->handleRequest($request);
        $projets=$ApprenantRepository->findAll();
        if($form->isSubmitted() && $form->isValid()){
        $entityManager =$this->getDoctrine()->getManager();
        
        
        
        $entityManager->persist($projects);
        $entityManager->flush();
        return $this->redirect($request->getUri());
        }
        return $this->render('apprenant_controlller/index.html.twig',[
        'form'=>$form->createView(),
        'projets'=>$projets
        ]);
        
    }

   
    
}
