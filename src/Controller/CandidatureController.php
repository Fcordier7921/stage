<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Candidature;
use App\Form\CandidatureFromType;
use App\Repository\CandidatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CandidatureController extends AbstractController
{

    //ajout d'une candidature
    /**
     * @Route("/apprenant/candidature/{id}", name="candidature")
     */
    public function FromRegister($id, Request $request, EntityManagerInterface $manager, Apprenant $apprenant):Response
    {
        
        

        $candidature= new Candidature();
        
       //formulailaire
        $form =$this->createForm(CandidatureFromType::class, $candidature); 
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $form->getData() ;
            
            $candidature = $form->getData();
            
            $candidature->setStatut('En attente');
            $candidature->setApprenant($apprenant);
            
            $pod=$candidature->getApprenant();
            
            $poduse= $pod ->getUsers();
            $idapp= $poduse->getId();
            
            $manager->persist($candidature);
            $manager->flush();
            return $this->redirect('/apprenant/fiche/'.$idapp);

        }

       return $this->render('candidature/candidature.html.twig', [
            'form' =>$form->createView()
        ]);
    }



    //mise a jour d'une candidature
    /**
     * @Route("/apprenant/upeadcandidature/{id}", name="upeadcandidature")
     */
    public function FromUpdeat($id, Request $request, EntityManagerInterface $manager, CandidatureRepository $CandidatureRepository):Response
    {
        

        $candidature=$CandidatureRepository->findOneBy(['id'=>$id]);
        $apprenant=$candidature->getApprenant();  
        // dd($apprenant);
       //formulailaire
        $form =$this->createForm(CandidatureFromType::class, $candidature); 
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $form->getData() ;
            
            $candidature = $form->getData();
            $candfunction= $candidature->getDateRelance();
            $cadstat=$candidature->getStatut();
            if($candfunction != null && $cadstat == 'En attente'){
                $candidature->setStatut('Relancée');
            }
            $candidature->setApprenant($apprenant);
            $pod=$candidature->getApprenant();
            
            $poduse= $pod ->getUsers();
            $idapp= $poduse->getId();
            
            $manager->persist($candidature);
            $manager->flush();
            return $this->redirect('/apprenant/fiche/'.$idapp);

        }

       return $this->render('candidature/Upedatcandidature.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
