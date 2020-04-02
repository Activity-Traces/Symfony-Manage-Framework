<?php

namespace App\Controller;


use App\SQL\sqlRequests;

use App\Entity\Competence;
use App\Form\MySearchType;
use App\Entity\Referentiel;
use App\Form\ReferentielType;
use App\Form\AssociateRefCompType;
use App\Repository\CompetenceRepository;
use App\Repository\ReferentielRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ReferentielsController extends AbstractController
{
   
#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
    /**
     * @Route("/", name="Home")
     */

    public function root()
    {
        return $this->render('base.html.twig');
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
    //view all references    

    /** 
     *  
     * @Route("/referentiels", name="viewAllReferentiels")   
    */
    public function viewAllReferentiels(                                                                       
                                        ObjectManager $manager,
                                        Request $request,
                                        ReferentielRepository $ReferentielRep,
                                        UserInterface $user
                                    )
    {

        // create assocaite form: use user to filter comptenences and referentiels related to this user 
        $formAssociate = $this
                        ->createForm(AssociateRefCompType::class, ['user'=>$user]);

        $formAssociate->handleRequest($request);

        if($formAssociate->isSubmitted() && $formAssociate->isValid()) {

            $RefElem = new Referentiel();
            $CompElem= new Competence();

            $RefElem=$formAssociate['titre']->getData(); 
            $CompElem = $formAssociate['nom']->getData();

           // $refId=$RefElem->getId();
   
           // $result = $ReferentielRep->findBy(['user' => $user->getId()]);

            foreach ($CompElem as $line){
                                
                $RefElem->addCompetence($line);
                $manager->persist($RefElem);
                $manager->flush();
            }

            return $this->render(   
                                    'referentiels/viewOneReferentiel.html.twig', 
                                    [ 
                                        'referentiel'=>$RefElem 
                                    ]
                                );
        }

        //Create the research form

        $form = $this
                ->createForm(MySearchType::class);

        $form->handleRequest($request);
        $sendSearch=false;
    
        // is the search-form submitted? 

        if($form->isSubmitted() && $form->isValid()) {
            $sendSearch=true;
            $search = $form['search']->getData();
            $Query = new sqlRequests;
            $Query = new sqlRequests;
            $result = $Query->find($manager, $search, 'Referentiel','titre', $user->getId());
           // $result = $ReferentielRep->findBy(['titre' => $search]);
                
        }

        if ($sendSearch==false)
            $result = $ReferentielRep->findBy(['user' => $user->getId()]);

        return $this->render(
                                'referentiels/viewAllReferentiels.html.twig', 
                                [
                                    'result' => $result,
                                    'form' => $form->createView(),
                                    'AssociateForm' => $formAssociate->createView()
                                    
                                ]
                            );
    
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /** Afficher un référentiel avec sa liste des compétences
     * Afficher aussi la compétence avec sa liste de modèles d'exercices
     * 
     * @Route("/referentiels/voir/{id}", name="viewOneReferentiel") 

    */

    public function viewOneReferentiel(Referentiel $Referentiel)

    {
        return $this->render(
                                'referentiels/viewOneReferentiel.html.twig', 
                                [                            
                                'referentiel'=>$Referentiel,    
                                ]
                            );
        
    }


#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /** Add new Referentiel
     * 
     * @Route("/referentiels/ajouter", name="addReferentiel")
    */

    public function AddReferentiel  ( ObjectManager $manager,                                               
                                      Request $request,
                                      UserInterface $user      
                                    )
    {

       
        $Ref_Record = new Referentiel();
        $form = $this
                ->createForm(ReferentielType::class, $Ref_Record);
                    
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        
            $Ref_Record->setUser( $user);  
            $Ref_Record->setIsshared('0');  
             
            $manager->persist($Ref_Record);    
            $manager->flush();
            return $this->redirectToRoute('viewAllReferentiels');

        }

        return $this->render('referentiels/updateReferentiels.html.twig', 
                                [
                                    'form' => $form->createView(), 
                                    'action'=>'AddReferentiel'
                                ]
                            );    
    
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

/** To edit referentiel or a competence
 * 
 * @Route("/referentiels/editer/{id}", name="editReferentiel")
*/

    public function editReferentiel(  ObjectManager $manager,
                                                Referentiel $Ref_Record,
                                                Request $request,                                                
                                                $id
                                            )
    {

        $form = $this
                ->createForm(ReferentielType::class, $Ref_Record);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {   
            $manager->persist($Ref_Record);    
            $manager->flush();
            return $this->redirectToRoute('viewAllReferentiels');

        }
        
        return $this->render( 'referentiels/updateReferentiels.html.twig', 
                                [
                                    'form' => $form->createView(),
                                    'action'=>'EditReferentiel'
                                ]
                            );    
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

/** Delete one referentiel
 * 
 * @Route("/referentiels/supprimer/{id}", name="deleteReferentiel")
*/


public function deleteOneReferentiel(   ObjectManager $manager,
                                        Referentiel $Ref_Record,
                                        $id                     
                                    )
    {

        $manager->remove($Ref_Record);
        $manager->flush();   
        return $this->redirectToRoute('viewAllReferentiels');

    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

/** Delete all referentiels or competences
 * 
 * @Route("/referentiels/toutsupprimer", name="clearAllReferentiels")
*/

    public function clearAllReferentiels(   ReferentielRepository $ReferentielRep,
                                            ObjectManager $manager,  
                                            UserInterface $user                                 
                                    )
    {

        $Query = new sqlRequests;
  

        $Query->deleteAll($manager, "Referentiel", $user);
        return $this->redirectToRoute("viewAllReferentiels");
        

    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
/* CLASS END */

}
