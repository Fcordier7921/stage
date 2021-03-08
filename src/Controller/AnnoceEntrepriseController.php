<?php

namespace App\Controller;

use App\Entity\AnnonceEntreprise;

use App\Form\AnnonceEFromType;
use App\Repository\AnnonceEntrepriseRepository;
use App\Repository\ApprenantRepository;
use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoceEntrepriseController extends AbstractController
{
    
    //gestion de l'affichage pour l'interface entreprise des annonce
    /**
     * @Route("/entreprise/annoce/{idu}/{ide}", name="entreprise_annoce")
     */
    public function AffAnnoce($idu,$ide, ContactRepository $contactRepository, EntrepriseRepository $entrepriseRepository, AnnonceEntrepriseRepository $annonceEntreprise ) : Response
    {       
        $projets=$entrepriseRepository->findOneBy(['id'=>$ide]);//info de la fiche entrerpise
        
        $contact=$contactRepository->findBy(['entreprise'=>$ide]);//info des contacte entreprise
        $annonce=$annonceEntreprise->findBy(['entreprise'=>$ide]);
        // dd($annonce);
        
        return $this->render('annoce_entreprise/annonce.html.twig', [
            'info' => $projets,
            'entreprise'=>$idu,
            'contacts'=>$contact,
            'annonces'=>$annonce
            
        ]);
    }

    //gestion de l'affichage pour l'interface pour les stagiaire pour voir les annoce
    /**
     * @Route("/apprenant/annoce/{id}/{idu}", name="apprenant_annoce")
     */
    public function AffAnnonceApprenat($id, $idu, AnnonceEntrepriseRepository $annonceEntreprise, ApprenantRepository $apprenantRepository, EntrepriseRepository $entreprise ) : Response
    {       
        
       $apprenant=$apprenantRepository->findBy(['id'=>$id]);
       $annonceEm=$annonceEntreprise->findALL();
       
        $nbEntreprise=count($annonceEm);
        for($i=0; $i<$nbEntreprise; $i++){
                $entrepriseId=$annonceEm[$i]->getEntreprise()->getId();
               
                $DataEntreprise=$entreprise->findBy(['id'=> $entrepriseId]);
                 $annonceEm[$i]->setEntreprise($DataEntreprise[0]);
               
        }
                
        
       
        
        return $this->render('annoce_entreprise/annonceApprenant.html.twig', [
            'info'=>$apprenant[0],
            'annonces'=>$annonceEm,
            'entreprise'=>$idu
        ]);
    }

    //Ajout d'une offre de stage
    /**
     * @Route("/entreprise/annoce/register/{idu}/{ide}", name="annonce_register")
     */
    public function FromRegister($idu, $ide, Request $request, EntityManagerInterface $manager, EntrepriseRepository $entreprise):Response
    {
        


        $task= new AnnonceEntreprise();
        
       
        $form =$this->createForm(AnnonceEFromType::class, $task); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $identrepriseData=$entreprise->findBy(['id'=>$ide]);
            $identreprise=$identrepriseData;
            
            $task->setEntreprise($identreprise[0]);
            $task->setEtatValidation(0);
            
            $manager->persist($task);
            $manager->flush();
            return $this->redirect("/entreprise/annoce/$idu/$ide");
            
        }
    
        return $this->render('annoce_entreprise/annonceRegister.html.twig', [
            'form' =>$form->createView()
            ]);
    }

    //Modifier une offre de stage
    /**
     * @Route("/entreprise/annoce/Updeat/{idu}/{ide}/{ida}", name="annonce_updeat")
     */
    public function FromUpdeat($idu, $ide,$ida, Request $request, EntityManagerInterface $manager, EntrepriseRepository $entreprise, AnnonceEntrepriseRepository $annonceEntrepriseRepository):Response
    {
        
        $task=$annonceEntrepriseRepository->findOneBy(['id'=>$ida]);

        $form =$this->createForm(AnnonceEFromType::class, $task); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $identrepriseData=$entreprise->findBy(['id'=>$ide]);
            $identreprise=$identrepriseData;
            
            $task->setEntreprise($identreprise[0]);
            $task->setEtatValidation(0);
            
            
            $manager->persist($task);
            $manager->flush();
            return $this->redirect("/entreprise/annoce/$idu/$ide");
            
        }
    
        return $this->render('annoce_entreprise/annonceRegister.html.twig', [
            'form' =>$form->createView()
            ]);
    }

    //supprimer une offre de stage
    /**
     * @Route("/entreprise/annoce/remove/{idu}/{ide}/{ida}", name="annonce_remove")
     */
    public function FromRemov($idu, $ide,$ida, Request $request, EntityManagerInterface $manager, AnnonceEntrepriseRepository $annonceEntrepriseRepository):Response
    {
        
        $task=$annonceEntrepriseRepository->findOneBy(['id'=>$ida]);
            $manager->remove($task);
            $manager->flush();
            return $this->redirect("/entreprise/annoce/$idu/$ide");
        
    }
}
