<?php

namespace App\Controller\Admin;

use App\Entity\AnnonceEntreprise;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use App\Entity\Apprenant;
use App\Entity\Candidature;
use App\Entity\Entreprise;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnonceEntrepriseRepository;
use App\Repository\CandidatureRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\ApprenantRepository;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;


class DashboardController extends AbstractDashboardController
{
    /**
     * @var AnnonceEntrepriseRepository
     */
    protected $AnnonceEntrepriseRepository;

    /**
     * @var ApprenantRepository
     */
    protected $ApprenantRepository;

    /**
     * @var CandidatureRepository
     */
    protected $CandidatureRepository;

    /**
     * @var EntrepriseRepository
     */
    protected $EntrepriseRepository;

    /**
     * @var UserRepository
     */
    protected $UserRepository;

    public function __construct(

        AnnonceEntrepriseRepository $AnnonceEntrepriseRepository,
        ApprenantRepository $ApprenantRepository,
        CandidatureRepository $CandidatureRepository,
        EntrepriseRepository $EntrepriseRepository,
        UserRepository $UserRepository
    )
    {
        
        $this->AnnonceEntrepriseRepository = $AnnonceEntrepriseRepository;
        $this->ApprenantRepository = $ApprenantRepository;
        $this->CandidatureRepository = $CandidatureRepository;
        $this->EntrepriseRepository = $EntrepriseRepository;
        $this->UserRepository = $UserRepository;
        
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        //recupérer tout les apprenand
        $apprenant=$this->ApprenantRepository->findAll();
        //trier le apprenant avec une candidature positive + qui sont d'une promotion encours
        $positif=$this->CandidatureRepository->countAppPositif();//recupére le candidature
        
        $this->EntrepriseRepository->findAll();
        $apprenantActuelle=[];
        $apprenantActuelleId=[];
        $now=new \DateTime();//récuperation de la date du jour
        $nowYearn=$now->format('Y-m');
        //
        for($i=0; $i <count($apprenant); $i++)
        {
            $date=$apprenant[$i]->getPromoAnne();//recuperation de la date de promo
            $dateDebut=$date->format('Y-m');//format de la date
            $dateMonth=($date->format('m'))+8;//temps de formation
            //condition si la formation se déroule sur 2 anné différente
            if($dateMonth>12){
                $dateYear=($date->format('Y'))+1;
                $dateMonthCalcul=$dateMonth-12;
                $dateFin=$date->format("$dateYear-$dateMonthCalcul");
            }else{
                $dateFin=$date->format("Y-$dateMonth");
            }
            //comparaison si la date du jour et entre la date de début de formation et la date de fin de formation 
            if(($dateDebut<=$nowYearn && $nowYearn<=$dateFin))
            {
                array_push($apprenantActuelle, $apprenant[$i]);
                array_push($apprenantActuelleId, $apprenant[$i]->getId());
            }
        }
        

        $AllapprenantPositif=[];
        for($i=0; $i <count($positif); $i++)
        {
            array_push($AllapprenantPositif, $positif[$i]);  
        }
        
        //dans le tableau apprenant actuelle je suprime les apprenant non positif
        for($i=0; $i <count($positif); $i++)
        {
            $idPositifAppreant=$positif[$i]->getApprenant()->getId();
            if(in_array($idPositifAppreant, $apprenantActuelleId)){}   
            else
            {
                Unset($positif[$i]);
            }
        }

        //recupérer les apprenant qui on une date d'entretien
        $candidature=$this->CandidatureRepository->findAll();
        $entretien=[];
        for($i=0; $i<count($candidature); $i++)//recupuérer les stagiaire qui on une date d'entretien 
        {
            
            if($candidature[$i]->getDateEntretient() != null && $candidature[$i]->getStatut() != 'Négatif' && $candidature[$i]->getStatut() != 'Positif' )
            {
                if(in_array($candidature[$i], $entretien ))
                {
                    //ne rien faire
                }else
                {
                      array_push($entretien, $candidature[$i]); 
                }
            
            }

        }
        
        //il faut suprimer les apprenant qui ont trouver un stage
        $idpositif=[];
        $idEntretien=[];
        for($i=0; $i<count($AllapprenantPositif);$i++)//recuperer la liste des apprenant qui on un stage
        {
            array_push($idpositif, $AllapprenantPositif[$i]->getApprenant()); 
        }
        for($i=0; $i<count($entretien);$i++)//recuperer la liste des apprenant qui on un entretien
        {
            array_push($idEntretien, $entretien[$i]->getApprenant()); 
        }
        $apprenantEntrtienfilter=array_diff($idEntretien, $idpositif);//comparaison
        $definitifentreprient=[];//enlever les appreant qui on un stage
        for($i=0; $i<count($entretien); $i++)
        {
           if(in_array(($entretien[$i]->getApprenant()), $apprenantEntrtienfilter) )
           {
              array_push($definitifentreprient, $entretien[$i]); 
           }
        }
        
        //apprenant sana rien
        dd($apprenant[0]->getCandidature());
        

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllApprenant' => count($apprenantActuelle),
            'apprenentcountPositif'=> count($positif),
            'apprenentEnRecheche'=> (count($apprenantActuelle))-(count($positif)),
            'entretiens'=>$definitifentreprient,
            'apprenantCandidaturePositifs'=>$AllapprenantPositif,
            'apprenants'=>$apprenant,

        ]);
        
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Stage')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('les utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Les entreprises', 'fa fa-cogs', Entreprise::class);
        yield MenuItem::linkToCrud('Candidature Aprenant', 'fa fa-envelope-o', Candidature::class);
        yield MenuItem::linkToCrud('liste des apprenants', 'fa fa-file-zip-o', Apprenant::class);
        yield MenuItem::linkToCrud('Annonce des entreprises', 'fa fa-folder-o', AnnonceEntreprise::class);
    }

    
}
