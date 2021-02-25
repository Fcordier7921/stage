<?php

namespace App\Controller;


use App\Entity\Entreprise;
use App\Entity\User;
use App\Form\EntrepriseFromType;
use App\Repository\ApprenantRepository;
use App\Repository\CandidatureRepository;
use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EntrepriseController extends AbstractController
{
     //redirection vers la fiche a remplire  si elle n'est pas emplie
    /**
     * 
     * @Route("/route/{id}", name="entreprise_route")
     * 
     * 
     */
    public function filRegister(User $user)
    
    {  
        
        
        $id=$user->getId();
        $appuse=$user->getEntreprise();  
        // dd($apprenant);
        
            

            if($appuse != null)
            {
                return $this->redirect('/entreprise/fiche/'.$id);
            }
            
              return $this->redirect('/entreprise/registere/'.$id);  
            

       
       


    }

    //gestion de l'affichage pour l'interface entreprise
    /**
     * @Route("/entreprise/fiche/{id}", name="entreprise_fiche")
     */
    public function AffCandidature(User  $user, ContactRepository $contactRepository, CandidatureRepository $candidatureRepository, ApprenantRepository $apprenantRepository) : Response
    {
       
        $projets=$user->getEntreprise();//info de la fiche entre rpise
        $contact=$contactRepository->findBy(['entreprise'=>$projets->getId()]);

        //resortire les id des apprenant ayant trouver un stage
        $positif=$candidatureRepository->findBy(['statut'=>'Positif']);
        $Idpositif=[];
        for($i=0; $i<(count($positif)); $i++){
        array_push($Idpositif, $positif[$i]->getApprenant()->getId() );
        }
        
        $IdPositiftrie=array_unique($Idpositif);
        //resortire les id de tout les apprenants
        $apprenant=$apprenantRepository->findALL();
        $IdApprenant=[];
        for($i=0; $i<(count($apprenant)); $i++){
        array_push($IdApprenant, $apprenant[$i]->getId() );
        }
        
        //obtenir les id des apprenant n'ayant pas de stage 
        $resultApprentDispo=array_diff($IdApprenant, $IdPositiftrie);
        
        $ultime=$apprenantRepository->findBy(['id'=>$resultApprentDispo]);
        
      
        
        
        return $this->render('entreprise/fiche.html.twig', [
            'info' => $projets,
            'entreprise'=>$user->getId(),
            'contacts'=>$contact,
            'appres'=>$ultime,
            
        ]);


    } 

    //reseignement de la fiche entreprise
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


    //modifier les info de la fiche entreprise
    /**
     * 
     *@route("/upeadentreprise/{ide}/{idu}", name="update_entreprise")
     */
    public function updeatApprenant($ide, $idu, Request $request, EntityManagerInterface $manager, EntrepriseRepository $apps)
    {
        
        $task =$apps->findOneBy(['id'=>$ide]);
        $form =$this->createForm(EntrepriseFromType::class, $task); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $form->getData() ;
            
            $task = $form->getData();
            
        
            // $manager->persist($task);
            $manager->flush();
            return $this->redirect('/entreprise/fiche/'.$idu);

        }

       

        return $this->render('entreprise/entrepriseUpdeat.html.twig', [
            'formEntreprise' =>$form->createView()
            ]);
    }

}
