<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Referentiel;
use App\Repository\CompetenceRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\ReferentielRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

#**************************************************************************************************************************************#    

class AssociateRefCompType extends AbstractType
{

#**************************************************************************************************************************************#    

    public function buildForm(FormBuilderInterface $builder, array $options)

    {
    
        $user=$options['data'];
        $param=$user['user'];
        
        $builder
        ->add(  'titre', EntityType::class, 
                [
                    'class'=>Referentiel::class,

                    'query_builder' => function (ReferentielRepository $rep) use ($param) 
                    {
                        return $rep->createQueryBuilder('p')
                        ->where('p.user = :user')
                        ->setParameter('user', $param);
                    },

                    'choice_label'=>'titre', 'label'=>'Référentiels',
                    'multiple'=>false, 'required'=>true
                ]
        )

        ->add(  'nom', EntityType::class, 
                [
                    'class'=>Competence::class, 

                    'query_builder' => function (CompetenceRepository $rep) use ($param) {
                        return $rep->createQueryBuilder('p')
                        ->where('p.user = :user')
                        ->setParameter('user', $param);
                    },
                    
                    'choice_label'=>'nom', 'label'=>'Compétences',
                    'multiple'=>true, 'required'=>true
                ]
        );
    }

#**************************************************************************************************************************************#    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
}
