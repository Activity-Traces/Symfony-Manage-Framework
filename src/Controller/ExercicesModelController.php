<?php

namespace App\Controller;

use App\SQL\sqlRequests;
use App\Form\MySearchType;
use App\Entity\ClaireExerciseModel;
use App\Form\AssociateExoModelCompType;
use App\Repository\DirectoryRepository;
use App\Repository\AskerUsersRepository;
use App\Repository\ExerciseModelRepository;
use App\Entity\ClaireExerciseStoredExercise;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\ClaireExerciseStoredExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExercicesModelController extends AbstractController
{

 /**
     * @Route("/repertoires", name="repertoires")
     */
    public function viewrepertoires(
                                            UserInterface $user,
                                            AskerUsersRepository $AskerRep
                                        )
    {
            //Create the research form

  

       $Askeruser=$AskerRep->findOneBy(['username' => $user->getUsername()]);  
      ;


        return $this->render(
                                'exercices_model/repertoire.html.twig', 
                                [
                                    'user' => $Askeruser]
                            );


    }


    /**
     * @Route("/exercices", name="viewAllExercicesModelsssss")
     */
    public function viewAllExercicesModels(
                                            ExerciseModelRepository $ExerciceModelRep,
                                            ObjectManager $manager,
                                            Request $request,
                                            UserInterface $user
                                        )
    {
            //Create the research form

        $form = $this
              ->createForm(MySearchType::class);

        $form->handleRequest($request);
        $sendSearch=false;

        // is the search-form submitted? 

        if ($form->isSubmitted() && $form->isValid()) {
            
            $sendSearch=true;
            $Query = new sqlRequests;
            $search = $form['search']->getData();   

            $result = $Query->find($manager, $search, 'ClaireExerciseModel','title', $user->getAskerId());
                
        }

        // view comptences when the page is loaded

        if ($sendSearch==false)
            $result = $ExerciceModelRep->findBy(['author' => $user->getAskerId()]);

        return $this->render(
                                'exercices_model/viewExercicesModels.html.twig', 
                                [
                                    'result' => $result,                            
                                    'form' => $form->createView()
                                ]
                            );


    }
#**************************************************************************************************************************************#
#**************************************************************************************************************************************#



    /**
     * @Route("/exer/{parent}/{child}", name="viewAllExercicesModels")
     */
    public function viewAllExercicesModelsrep(
                                            ExerciseModelRepository $ExerciceModelRep,
                                            ObjectManager $manager,
                                            Request $request,
                                            UserInterface $user,
                                            DirectoryRepository $directoryRepo,
                                            $parent=null, $child=null
                                        )
    {

        #**************************************************************************************************************************************#
            //Create the research form

        $form = $this
              ->createForm(MySearchType::class);

        $form->handleRequest($request);
        $sendSearch=false;

        // is the search-form submitted? 

        if ($form->isSubmitted() && $form->isValid()) {
            
            $sendSearch=true;
            $Query = new sqlRequests;
            $search = $form['search']->getData();   

            $result = $Query->find($manager, $search, 'ClaireExerciseModel','title', $user->getAskerId());
                
        }

#**************************************************************************************************************************************#

        $ursid= $user->getAskerId();


        $sql="SELECT p FROM App\Entity\Directory p where (p.parent is null ) and ( p.owner in (select d From App\Entity\AskerUser d where d.id like :pm))";

        $query= $manager->createQuery($sql)      
                    ->setParameters(array('pm'=>$ursid )); 
    
        $result1 = $query->getResult();

        $a=array();

        foreach ($result1 as $rep){
                                
            $f= $rep->getId();
            $sql="SELECT p FROM App\Entity\Directory p where (p.parent = :pm )";
            $query= $manager->createQuery($sql)      
                        ->setParameters(array('pm'=>$f )); 
            $result2 = $query->getResult();

            $a[]=array($rep, $result2);
            
           

        }


        $result=null;
#**************************************************************************************************************************************#
        if ($sendSearch==false and $child!=null){

            
           // $result = $ExerciceModelRep->findBy(['author' => $user->getAskerId()]);
           $result = $directoryRepo->findmodelsbydirectory($child);
       
        }
                        
        return $this->render(
                                'exercices_model/viewExercicesModels.html.twig', 
                                [
                                    'result' => $result,                            
                                    'form' => $form->createView(),
                                    'directories'=>$a,
                                    'child'=>$child

                                ]
                            );


    }




    /** Afficher un référentiel avec sa liste des compétences
     * Afficher aussi la compétence avec sa liste de modèles d'exercices
     * 
     * @Route("/exercices/voir/{id}", name="viewOneExerciceModel") 

    */

    public function viewOneExerciceModel(   ClaireExerciseModel $exerciceModel, 
                                            ClaireExerciseStoredExerciseRepository $ExerciceStoredRep
                                        )

    {
     

        $exercices = $ExerciceStoredRep->findBy(['exerciseModel' => $exerciceModel->getId()]);

        

        return $this->render(

                                'exercices_model/viewOneExercicesModel.html.twig', 
                                [                            
                                'exerciceModel'=>$exerciceModel,
                                'exercices'=>$exercices
                                ]
                            );
        
    }


#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
}