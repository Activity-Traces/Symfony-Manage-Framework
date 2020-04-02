<?php

#**************************************************************************************************************************************#
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#**************************************************************************************************************************************#

class TracesController extends AbstractController
{

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#

    /**
     * @Route("/traces", name="traces")
     */
    public function index(request $request)
    {
     
        $form = $this
                ->createFormBuilder()
                ->add('fichier', FileType::class, ['label' => 'Choisir'])

                ->getForm();
    
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $choice = $request->get('Radio');
            $file = $form['fichier']->getData(); 
            
            $f=$file->getClientOriginalName();       
            return $this->redirectToRoute(
                                            'collectTrace',
                                            [
                                                'choice'=>$choice, 'file'=>$f
                                            ]
                                        );     

        }

        return $this->render(
                                'traces/configureSource.html.twig', 
                                [
                                    'form'=>$form->createView()
                                ]
                            );
    }


#**************************************************************************************************************************************#
    /**
     * @Route("/traces/charger/{choice}/{file}", name="collectTrace")
     */

    public function loadTrace($choice,$file)
    {
        return $this->render(
                                'traces/collectTraces.html.twig', 
                                [
                                    'choice'=>$choice, 
                                    'file'=>$file
                                ]
                            );
    }

#**************************************************************************************************************************************#

}


