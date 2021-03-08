<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Candidature;
use App\Entity\User;
use App\Form\ApprenantFromType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




/**
 * class ApprenantControlllerController
 * @package App\Controller
 * @route("/apprenant")
 */
class ApprenantControlllerController extends AbstractController
{
    

    //redirection vers la fiche a remplire  si elle n'est pas emplie
    /**
     * 
     * @Route("/route/{id}", name="apprenant_route")
     * 
     * 
     */
    public function filRegister(User $user, ApprenantRepository $apps)
    
    {  
        $apprenant=$apps->findAll();

        $id=$user->getId();
              
        // dd($apprenant);
        
       for($i=0; $i<count($apprenant); $i++){
            $appd=$apprenant[$i]->getUsers();
            $appuse= $appd->getid();
            

            if($appuse==$id)
            {
                return $this->redirect('/apprenant/fiche/'.$id);
            }
            

       }
       return $this->redirect('/apprenant/register/'.$id);


    } 
    
    
    //gestion de l'affichage des apprenant
    /**
     * @Route("/fiche/{id}", name="apprenant_fiche")
     */
    public function AffCandidature(User  $user) : Response
    {
        
        $idu=$user->getId();
        $projets=$user->getApprenant();
        $candidatures=$this->getDoctrine()
        ->getRepository(Candidature::class)
        ->findBy(['apprenant'=>$projets->getId()]);
        

        return $this->render('apprenant_controlller/fiche.html.twig', [
            'info' => $projets,
            'candidatures'=>$candidatures,
            'idu' => $idu
        ]);


    } 

    //reseignement de la fiche apprenent
    /**
     * @Route("/register/{id}", name="apprenant_register")
     */
    public function FromRegister(Request $request, User $user, EntityManagerInterface $manager):Response
    {
        


        $task= new Apprenant();
        
       //formulailaire
        $form =$this->createForm(ApprenantFromType::class, $task); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            if(($form->get('avatar')->getData()) != null)
            {
                $file = $form->get('avatar')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();
             
                 try {
                    $file->move(
                        $this->getParameter('brochures_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                
                }
                $task->setAvatar($fileName);
            }else{
                $task->setAvatar('5.png');
            }
            $speudoe=$task->getGit();
            $speudoexplode= explode('/', $speudoe );
            $speudo=$speudoexplode[3];
            $task->setSpeudogithub($speudo);

            $form->getData();
            
            $task = $form->getData();
            $task->setUsers($user);
            
            $id= $user ->getId();
            $manager->persist($task);
            $manager->flush();
            return $this->redirect('/apprenant/fiche/'.$id);

        }

       

        return $this->render('apprenant_controlller/index.html.twig', [
            'form' =>$form->createView()
            ]);
    }

    
    
    //modifier les info de la fiche apprenant
    /**
     * 
     *@route("/upeadaprenant/{id}", name="update_apprenant")
     */
    public function updeatApprenant($id, Request $request, EntityManagerInterface $manager, ApprenantRepository $apps)
    {
        $task =$apps->findOneBy(['id'=>$id]);
        
        $form =$this->createForm(ApprenantFromType::class, $task); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            if(($form->get('avatar')->getData()) != null)
            {
                $file = $form->get('avatar')->getData();
                
                $fileName = uniqid(). '.' .$file->guessExtension();
             
                 try 
                 {
                    $file->move(
                        $this->getParameter('brochures_directory'),
                        $fileName
                    );
                } 
                catch (FileException $e) 
                {
                
                }
                $task->setAvatar($fileName);
            }
            $speudoe=$task->getGit();
            $speudoexplode= explode('/', $speudoe );
            $speudo=$speudoexplode[3];
            $task->setSpeudogithub($speudo);
            
            $form->getData() ;
            
            $task = $form->getData();
            $pod=$task->getUsers();
            
            $idu= $pod ->getId();
            // $manager->persist($task);
            $manager->flush();
            return $this->redirect('/apprenant/fiche/'.$idu);

        }

       

        return $this->render('apprenant_controlller/index.html.twig', [
            'form' =>$form->createView()
            ]);
    }

     
   
    
}
