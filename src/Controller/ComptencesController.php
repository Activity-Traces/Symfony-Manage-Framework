<?php

namespace App\Controller;


use App\SQL\sqlRequests;

use App\Entity\Competence;
use App\Form\MySearchType;
use App\Entity\Referentiel;

use App\Form\CompetenceType;
use App\Form\AssociateRefCompType;
use App\Entity\ClaireExerciseModel;
use App\Form\AssociateExoModelCompType;

use App\Repository\CompetenceRepository;
use App\Repository\ReferentielRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComptencesController extends AbstractController
{
   
#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
    /** view all references
     * 
     * @Route("/competences", name="viewAllCompetences")
     
    */
    public function viewAllCompetences(
                                        CompetenceRepository $CompetenceRep,
                                        ObjectManager $manager,
                                      
                                        Request $request,
                                        UserInterface $user
                                    )
    {
/**************************************************************************************/

 // create assocaite form: use user to filter comptenences and referentiels related to this user 

 // il faut en premier trouver le askerid
    $UserId=$user->getId();
    $AskerId=$user->getAskerid();
  

    $formAssociate = $this
                        ->createForm(AssociateExoModelCompType::class, ['user'=>$user, 'askerid'=>$AskerId]);

    $formAssociate->handleRequest($request);
   

    if($formAssociate->isSubmitted() && $formAssociate->isValid()) {


        $CompElem= new Competence();
        $ExoModelElem = new ClaireExerciseModel();

        $CompElem = $formAssociate['nom']->getData();
        $ExoModelElem=$formAssociate['title']->getData(); 

       // $ExoModelId=$ExoModelElem->getAskerId();

       // $result = $ExerciceModelRep->findBy(['user' => $user->getAskerId()]);
        
        foreach ($ExoModelElem as $line){
          
            $CompElem->addModelesExercice($line);
            $manager->persist($CompElem);
            $manager->flush();
        }
        
       return $this->render(   
                    'competences/viewOneCompetence.html.twig', 
                    [ 
                        'competence'=>$CompElem 
                    ]
                );
    } 


/**************************************************************************************/
      
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
            $result = $Query->find($manager, $search, 'Competence','nom', $user->getId());
               
        }

        // view comptences when the page is loaded

        if ($sendSearch==false)
            $result = $CompetenceRep->findBy(['user' => $user->getId()]);

        return $this->render(
                                'competences/viewAllCompetences.html.twig', 
                                [
                                    'result' => $result,                            
                                    'form' => $form->createView(),
                                    'AssociateForm' => $formAssociate->createView()

                                ]
                            );

    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * 
     * @Route("/competences/voir/{id}", name="ViewOneCompetence") 

    */

    public function viewOneCompetence(Competence $Competence)

    {
        return $this->render(
                                'competences/viewOneCompetence.html.twig', 
                                [                            
                                'competence'=>$Competence,                                
                                ]
                            );
        
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /** Add new competence 
     * 
     * @Route("/competences/ajouter/", name="AddCompetence")
    */

    public function AddCompetence  (    ObjectManager $manager,                                               
                                        Request $request,
                                        UserInterface $user
                                    )
    {

        $userId = $user->getId(); 

        // Add a new competence
    
        $Comp_Record = new Competence();

        $form = $this
                ->createForm(CompetenceType::class, $Comp_Record);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $Comp_Record->setUser( $user); 
            $Comp_Record->setIsshared('0');
               
            $manager->persist($Comp_Record);    
            $manager->flush();
            return $this->redirectToRoute('viewAllCompetences');

        }

        return $this->render(
                                'competences/updateCompetences.html.twig', 
                                [
                                    'form' => $form->createView(), 
                                    'action'=>'AddCompetence'
                                ]
                            );    
    

    }

#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

/** To edit referentiel or a competence
 * 
 * @Route("/competences/editer/{id}", name="editCompetence")
*/

    public function EditCompetence(  ObjectManager $manager,
                                                Competence $Comp_Record=null,                                              
                                                Request $request, 
                                                $id
                                            )
    {

        $form = $this
                ->createForm(CompetenceType::class, $Comp_Record);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($Comp_Record);    
            $manager->flush();

            return $this->redirectToRoute('viewAllCompetences');

        }

        return $this->render(
                                'competences/updateCompetences.html.twig', 
                                [
                                    'form' => $form->createView(),
                                    'action'=>'EditCompetence'
                                ]
                            ); 


    }

#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

/** Delete one referentiel or compence
 * 
 * @Route("/competences/supprimer/{id}", name="deleteCompetence")
*/
// must null: when we call referentiel, competence is not defined so it must be null

public function deleteCompetence(   ObjectManager $manager,                        
                                    Competence $Comp_Record=null,                                            
                                    $id                     
                                )
{

        $manager->remove($Comp_Record);
        $manager->flush();   
        return $this->redirectToRoute('viewAllCompetences');

}


#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

    /** Delete only competences related ro referentiel: it does not delete an existing competence
     * 
     * @Route("/competences/supprimer/relation/{ref}/{id}", name="deleteCompetencesRelation")
    */

    public function deleteCompetencesRelation(  Competence $Com_Record,         
                                                ObjectManager $manager, 
                                                ReferentielRepository $ReferentielRep,
                                                $ref,
                                                $id
                                            )
    {

        $RefElem = new Referentiel();
        
        $RefElem=$ReferentielRep->findOneBy(['id' => $ref]);                    
        $RefElem->removeCompetence($Com_Record);
        $manager->flush();

        return $this->redirectToRoute(
                                        'viewOneReferentiel', 
                                        [
                                            'Referentiel'=>$RefElem, 
                                            'id'=>$ref
                                        ]
                                    );

    }


#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

/** Delete all referentiels or competences
 * 
 * @Route("/competences/toutsupprimer/", name="clearAllCompetences")
*/

    public function clearAllCompetences (  
                                            ObjectManager $manager,  
                                            UserInterface $user                                                                        
                                        )
    {

        $Query = new sqlRequests;

        $Query->deleteAll($manager, "Competence", $user);
            return $this->redirectToRoute("viewAllCompetences");
        
    }



#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
/* CLASS END */

}