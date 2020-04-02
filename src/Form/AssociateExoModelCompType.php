<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\ClaireExerciseModel;
use App\Repository\CompetenceRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\ExerciseModelRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociateExoModelCompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $user=$options['data'];
        $param=$user['user'];
        $param2=$user['askerid'];
    
        
        $builder

        ->add(  'nom', EntityType::class, 
                [
                    'class'=>Competence::class, 

                    'query_builder' => function (CompetenceRepository $rep) use ($param) {
                        return $rep->createQueryBuilder('p')
                        ->where('p.user = :user')
                        ->setParameter('user', $param);
                    },
                    
                    'choice_label'=>'nom', 'label'=>'Compétences',
                    'multiple'=>false, 'required'=>true
                ]
        )

        ->add(  'title', EntityType::class, 
                [
                    'class'=>ClaireExerciseModel::class, 

                    'query_builder' => function (ExerciseModelRepository $rep) use ($param2) {
                        return $rep->createQueryBuilder('p')
                        ->where('p.author = :user')
                        ->setParameter('user', $param2);
                    },
                    
                    'choice_label'=>'title','label'=>'Modèles Exercices',
                    'multiple'=>true, 'required'=>true
                ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
