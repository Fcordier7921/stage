<?php

namespace App\Controller;

use App\Entity\Apprenant;
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
    


    /**
     * @Route("/route/{id}", name="apprenant_route")
     */
    public function filRegister(User $user, Apprenant $apprenant)
    
    {  
        

        $id=$user->getId();
        $apprenant =new Apprenant();
        // $Apprenant->getApprenant();
        
        $idApprenant= $apprenant->getId();
        dd($idApprenant);
        // for( user = Apprenant)
        // if( $id  ){

        //     return $this->redirect('/apprenant/fiche/'.$id);
        // }
        // else{
        //     return $this->redirect('/apprenant/register/'.$id);
        // }


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
            //onrecuperere les image transmise
            // $images =$form->get('avatar')->getData();
            // if($task->getAvatar() !==null){
                $file = $form->get('avatar')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();
                
                // $originalFilename = pathinfo($images->getClientOriginalName(), PATHINFO_FILENAME);
                // // on génére un nouveau non f=de fichier
                // $safeFilename = $slugger->slug($originalFilename);
                // $newFilename = $safeFilename.'-'.uniqid().'.'.$images->$exts;
                 // Move the file to the directory where brochures are stored
                 try {
                    $file->move(
                        $this->getParameter('brochures_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                // }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $task->setAvatar('toto.jpg');
            }
            $manager->persist($task);
            $manager->flush();

            $form->getData() ;
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            $task->setUsers($user);
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
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
     * @Route("/fiche/{id}", name="apprenant_fiche")
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
