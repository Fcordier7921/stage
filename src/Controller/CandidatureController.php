<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Candidature;
use App\Form\CandidatureFromType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CandidatureController extends AbstractController
{
    /**
     * @Route("/apprenant/candidature/{id}", name="candidature")
     */
    public function FromRegister(Request $request, EntityManagerInterface $manager):Response
    {
        


        $candidature= new Candidature();
        
       //formulailaire
        $form =$this->createForm(CandidatureFromType::class, $candidature); 
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $form->getData() ;
            dd($form);
            $candidature = $form->getmodelData();
            
            $candidature->setUsers($user);
            
            $id= $user ->getId();
            $manager->persist($candidature);
            $manager->flush();
            return $this->redirect('/apprenant/fiche/'.$id);

        }

       return $this->render('candidature/candidature.html.twig', [
            'form' =>$form->createView()
        ]);
    }


}
