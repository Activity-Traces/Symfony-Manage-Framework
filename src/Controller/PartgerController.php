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


#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

class PartgerController extends AbstractController
{
    /**
     * @Route("/partage", name="share")
     */
    public function shareReferentiels(
                                        ReferentielRepository $ReferentielRep,
                                        CompetenceRepository $CompetenceRep
                                    )
    {

        $SharedRef = $ReferentielRep->findBy(['isshared' => '1']);
        $SharedComp = $CompetenceRep->findBy(['isshared' => '1']);


        return $this->render('share/sharedList.html.twig', [
            'SharedRef' => $SharedRef,
            'SharedComp' => $SharedComp
            
        ]);
    }


#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * @Route("/referentiels/partager/{id}", name="canShareReferentiel")
     */

    public function canShareReferentiel (   ObjectManager $manager, 
                                            Referentiel $ref,
                                            $id
                                        ) 
    {

        $actif=$ref->getIsshared();
       
         
        if($actif)
            $ref->setIsshared('0');
        else
            $ref->setIsshared('1');
               
        $manager->persist($ref);    
        $manager->flush();

        return $this->redirectToRoute('viewAllReferentiels');

    }


#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * @Route("/competences/partager/{id}", name="canShareCompetence")
     */

    public function canShareCompetence(  ObjectManager $manager, 
                                         Competence $comp,
                                         $id
                                    ) 
    {

        $actif=$comp->getIsshared();
         
        if($actif)
            $comp->setIsshared('0');
        else
            $comp->setIsshared('1');
               
        $manager->persist($comp);    
        $manager->flush();

        return $this->redirectToRoute('viewAllCompetences');

    }


#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * @Route("/referentiels/importer/{id}", name="importReferentiel")
     */

    public function importReferentiel(  ObjectManager $manager,
                                        Referentiel $ref,
                                        UserInterface $user, 
                                        $id
                                    ) 
    {

        $Ref_Record = new Referentiel();

        $Ref_Record->setTitre('Imported_'.$ref->getTitre());
        $Ref_Record->setDescription($ref->getDescription());

        $Ref_Record->setUser( $user);  
        $Ref_Record->setIsshared('0');  
            
        $manager->persist($Ref_Record);    
        $manager->flush();
        return $this->redirectToRoute('viewAllReferentiels');


    }



#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * @Route("/competences/importer/{id}", name="importCompetence")
     */

    public function importCompetence(  ObjectManager $manager,
                                        Competence $comp,
                                        UserInterface $user, 
                                        $id
                                    ) 
    {

        $Comp_Record = new Competence();

        $Comp_Record->setNom('Imported_'.$comp->getNom());
        $Comp_Record->setDescription($comp->getDescription());
        $Comp_Record->setNiveauResponsabilite($comp->getNiveauResponsabilite());
        $Comp_Record->setNiveauCompetence($comp->getNiveauCompetence());

        $Comp_Record->setUser( $user);  
        $Comp_Record->setIsshared('0');  
            
        $manager->persist($Comp_Record);    
        $manager->flush();
        return $this->redirectToRoute('viewAllCompetences');


    }

#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/

}
