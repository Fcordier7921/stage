<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\ApprenantFromType;
use App\Repository\ApprenantRepository;
use App\Repository\CandidatureRepository;
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


    /**
     * @Route("/register/{id}", name="apprenant_register")
     */
    public function FromRegister(Request $request, User $user, EntityManagerInterface $manager):Response
    {
        // $mimeTypes = new MimeTypes();

        // $exts = $mimeTypes->getExtensions('image/jpeg');


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
            $form->getData() ;
            
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
    /**
     * @Route("/fiche/{id}", name="apprenant_fiche")
     */
    public function AffCandidature($id, ApprenantRepository $ApprenantRepository, User  $user, CandidatureRepository $CandidatureRepository) : Response
    {
       
        $user =$this-> getUser();
        $id= $user ->getId();
        // $apprenant=$CandidatureRepository->findOneBy(['id'=>$id]);
        // dd($apprenant);
        // $idApp=$apprenant->getId();
        $projets=$ApprenantRepository->findByExampleField($id);
        // $cands=$CandidatureRepository->findByExampleField($idApp);
        // dd($projets);
        return $this->render('apprenant_controlller/fiche.html.twig', [
            'fiche' => $projets,
            // 'candidature' => $cands,
            
        ]);


    }  
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
                dd( $form->get('avatar')->getData());
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
