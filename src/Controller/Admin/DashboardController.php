<?php

namespace App\Controller\Admin;

use App\Entity\AnnonceEntreprise;
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
        $positif=$this->CandidatureRepository->countAppPositif();
        $apprenant=$this->ApprenantRepository->findAll();
        $apprenantActuelle=[];
        $apprenantActuelleId=[];
        $now=new \DateTime();
        $nowYearn=$now->format('Y-m');
        //identifier les apprenant de la promo actuel
        for($i=0; $i <count($apprenant); $i++)
        {
            $date=$apprenant[$i]->getPromoAnne();
            $dateDebut=$date->format('Y-m');
            $dateMonth=($date->format('m'))+8;
            if($dateMonth>12){
                $dateYear=($date->format('Y'))+1;
                $dateMonthCalcul=$dateMonth-12;
                $dateFin=$date->format("$dateYear-$dateMonthCalcul");
            }else{
                $dateFin=$date->format("Y-$dateMonth");
            }
            
            if(($dateDebut<=$nowYearn && $nowYearn<=$dateFin))
            {
                array_push($apprenantActuelle, $apprenant[$i]);
                array_push($apprenantActuelleId, $apprenant[$i]->getId());
            }
        }
        //enlever les apeant des autre promo
        for($i=0; $i <count($positif); $i++)
        {
            $idPositifAppreant=$positif[$i]->getApprenant()->getId();
            if(in_array($idPositifAppreant, $apprenantActuelleId)){}   
            else
            {
                Unset($positif[$i]);
            }
        }
        
    
        
        
        
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllApprenant' => count($apprenantActuelle),
            'apprenentCandidaturePositif'=> count($positif),
            'apprenentEnRecheche'=> (count($apprenantActuelle))-(count($positif)),

            'apprenantCandidature'=>'$attent'
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
        yield MenuItem::linkToCrud('Les annoce poster par le apprenent', 'fa fa-envelope-o', Candidature::class);
        yield MenuItem::linkToCrud('liste des apprenants', 'fa fa-file-zip-o', Apprenant::class);
        yield MenuItem::linkToCrud('Annonce des entreprises', 'fa fa-folder-o', AnnonceEntreprise::class);
    }
}
