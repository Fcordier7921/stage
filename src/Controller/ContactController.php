<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactEFromType;
use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
   //reseignement de la fiche contact entreprise
    /**
     * @Route("/entreprise/contactregistere/{idu}/{ide}", name="contact_registere")
     */
    public function FromRegister($idu, $ide, Request $request, EntityManagerInterface $manager, EntrepriseRepository $entreprise ):Response
    {
        
        

        $task= new Contact();
        
       //formulailaire
        $formc =$this->createForm(ContactEFromType::class, $task); 
        $formc->handleRequest($request);
        
        if ($formc->isSubmitted() && $formc->isValid()) {
           
            $formc->getData();
            
            $task = $formc->getData();
            
            $task->setEntreprise($entreprise, $ide);
            
           
            
            $manager->persist($task);
            $manager->flush();
            return $this->redirect('/entreprise/fiche/'.$idu);

        }

       

        return $this->render('entreprise/entrepriseContactRegister.html.twig', [
            'formContact' =>$formc->createView()
            ]);
    }



    //modifier de la fiche contact entreprise
    /**
     * @Route("/entreprise/contactUpdeat/{idc}/{idu}", name="contact_Updeat")
     */
    public function FromUpdeat($idc, $idu, Request $request, EntityManagerInterface $manager, ContactRepository $contactr ):Response
    {

        
        

        $task =$contactr->findOneBy(['id'=>$idc]);
        
       //formulailaire
        $formc =$this->createForm(ContactEFromType::class, $task); 
        $formc->handleRequest($request);
        
        if ($formc->isSubmitted() && $formc->isValid()) {
           
            $formc->getData();
            
            $task = $formc->getData();
            
            
            
           
            
            $manager->persist($task);
            $manager->flush();
            return $this->redirect('/entreprise/fiche/'.$idu);

        }

       

        return $this->render('entreprise/entrepriseContactUpdeat.html.twig', [
            'formContact' =>$formc->createView()
            ]);
    }


    
}
