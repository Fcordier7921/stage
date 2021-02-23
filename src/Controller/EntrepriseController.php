<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\User;
use App\Form\EntrepriseFromType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function index(): Response
    {
        return $this->render('entreprise/entreprise.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }

//     //gestion de l'affichage pour l'interface entreprise
//     /**
//      * @Route("/entreprise/fiche/{id}", name="entreprise_fiche")
//      */
//     public function AffCandidature(User  $user) : Response
//     {
       
//         $projets=$user->getApprenant();
//         $candidatures=$this->getDoctrine()
//         ->getRepository(Candidature::class)
//         ->findBy(['apprenant'=>$projets->getId()]);
//         // dd($candidatures);
//         return $this->render('entreprise/fiche.html.twig', [
//             'info' => $projets,
//             'candidatures'=>$candidatures      
//         ]);


//     } 

    //reseignement de la fiche apprenent
    /**
     * @Route("/entreprise/registere/{id}", name="entreprise_registere")
     */
    public function FromRegister(Request $request, User $user, EntityManagerInterface $manager):Response
    {
        


        $task= new Entreprise();
        
       //formulailaire
        $forme =$this->createForm(EntrepriseFromType::class, $task); 
        $forme->handleRequest($request);
        if ($forme->isSubmitted() && $forme->isValid()) {
           
            $forme->getData();
            
            $task = $forme->getData();
            $task->setUser($user);
            
            $id= $user ->getId();
            $manager->persist($task);
            $manager->flush();
            return $this->redirect('/entreprise/fiche/'.$id);

        }

       

        return $this->render('entreprise/entrepriseRgister.html.twig', [
            'formEntreprise' =>$forme->createView()
            ]);
    }
}
