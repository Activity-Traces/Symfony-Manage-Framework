<?php
namespace App\Controller;
use App\Utils\EvaluateEquation;

use App\Utils\Graphics;
use App\Entity\Competence;
use App\Entity\Referentiel;
use App\Form\DefineIndicatorType;
use App\Form\ComputeIndicatorType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndicatorsController extends AbstractController
{

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

// under devloppment: 12 fevrier 2019
/** 
 * @Route("/indicateurs", name="CreateIndicator")
*/

public function createIndicatorForm( 
                                    Referentiel $Ref_Record = null,
                                    ObjectManager $manager,
                                    Request $request,
                                    UserInterface $user
                            )
{
    $choice='';
    $ref='';
    $timeval='';
    $titre='';

    $form = $this
            ->createForm(DefineIndicatorType::class, ['user'=>$user]);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {

        $choice = $request->get('Radio');
        $ref = $form['titre']->getData();        
        $titre=$ref->getTitre();
        $timeInterval = $form['Interval']->getData();        
  
        return $this->redirectToRoute(
                                        'viewIndicator',
                                        [
                                            'choice'=>$choice, 
                                            'ref'=>$titre, 
                                            'timeVal'=>$timeInterval->getTimestamp(), 
                                            
                                        ]
                                    );     

    }
    
    return $this->render(
                            'indicators/createindicator.html.twig', 
                            [
                                'form'=>$form->createView()
                            ]
                        );     
}


#**************************************************************************************************************************************#/

// under devloppment: 12 fevrier 2019
/** 
 * @Route("/indicateurs/Afficher/{type}", name="viewIndicator")
*/

    public function ComputeIndicators(Request $request, $type=null){

#**************************************************************************************************************************************#/
    //  computation parameters
   

    $choix=$request->query->get('choice');
    $time=$request->query->get('timeVal');
    $ref=$request->query->get('ref');

    if($type==null)
    $type='bar';
    // test values
    
    $x=json_encode([15339,12339,28339,21345,18483,24003,23489,24092,12034]);


    return $this->render(
        'indicators/indicator.html.twig',
        ['x'=>$x,
        'type'=>$type,
        'choice'=>$choix,
        'ref'=>$ref,
        'timeVal'=>$time
        ]
    );
            

    }

#**************************************************************************************************************************************#/
#**************************************************************************************************************************************#/
       
}
