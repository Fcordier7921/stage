<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\ApprenantFromType;
use App\Repository\ApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * class ApprenantControlllerController
 * @package App\Controller
 * @route("/apprenant", name="apprenant_")
 */
class ApprenantControlllerController extends AbstractController
{

    // /**
    //  * @Route("/fiche/{id}", name="fiche")
    //  */
    // public function filRegister(User $user, Apprenant $apprenant)
    // {
    //     $users = new User();
    //     dd($user);
    //     if( $users){

    //         return $this->redirectToRoute('apprenant_fiche');
    //     }
    //     else{
    //         return $this->redirectToRoute('apprenant_register');
    //     }


    // } 

    
    /**
     * @Route("/register/{id}", name="register")
     */
    public function FromRegister(Request $request, User $user):Response
    {
        $task= new Apprenant();
       //formulailaire
        $form =$this->createForm(ApprenantFromType::class, $task); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData() ;
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            $task->setUsers($user);
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            $id= $user ->getId();
            // return $this->redirect($request->getUri());
            // return $this->redirectToRoute('fiche', ['5']);
            return $this->redirect('/apprenant/fiche/'.$id);

        }

       

        return $this->render('apprenant_controlller/index.html.twig', [
            'form' =>$form->createView()
            ]);
    }
    /**
     * @Route("/fiche/{id}", name="fiche")
     */
    public function AffCandidature(ApprenantRepository $ApprenantRepository, User  $user) : Response
    {
       
        $user =$this-> getUser();
        $id= $user ->getId();
        $projets=$ApprenantRepository->findByExampleField($id);
        // dd($projets);
        return $this->render('apprenant_controlller/fiche.html.twig', [
            'fiche' => $projets,
            
        ]);


    }  

     
   
    
}
