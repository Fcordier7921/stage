<?php

namespace App\Controller;

use App\Entity\User;


use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoceEntrepriseController extends AbstractController
{
    /**
     * @Route("/annoce/entreprise", name="annoce_entreprise")
     */
    public function index(): Response
    {
        return $this->render('annoce_entreprise/index.html.twig', [
            'controller_name' => 'AnnoceEntrepriseController',
        ]);
    }
    //gestion de l'affichage pour l'interface entreprise des annonce
    /**
     * @Route("/entreprise/annoce/{ide}/{idu}", name="entreprise_annoce")
     */
    public function AffCandidature($ide,$idu, ContactRepository $contactRepository, EntrepriseRepository $entrepriseRepository ) : Response
    {

       
        $projets=$entrepriseRepository->findOneBy(['id'=>$ide]);//info de la fiche entrerpise
        
        $contact=$contactRepository->findBy(['entreprise'=>$projets->getId()]);//info des contacte entreprise

        return $this->render('annoce_entreprise/annonce.html.twig', [
            'info' => $projets,
            'entreprise'=>$ide,
            'contacts'=>$contact,
            
        ]);
    }
}
