<?php

namespace App\Form;

use DateTime;
use App\Entity\Referentiel;
use Symfony\Component\Form\AbstractType;
use App\Repository\ReferentielRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DefineIndicatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user=$options['data'];
        $param=$user['user'];
        
        $builder
            ->add   (  'titre', EntityType::class, 
                        [
                            'class'=>Referentiel::class,

                            'query_builder' => function (ReferentielRepository $rep) use ($param) {
                                return $rep->createQueryBuilder('p')
                                ->where('p.user = :user')
                                ->setParameter('user', $param);
                            },
            
                            'choice_label'=>'titre',
                            'label'=>'Quel référentiel vous voulez evaluer?',

                            'multiple'=>false, 
                            'required'=>true                        ]
                    )
                
            ->add   (  'Interval', DateTimeType::class, 
                        [
                            'widget' => 'single_text','label'=>'collecter à partir du',
                            'data' => new \DateTime("now")
                        ]
                    )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
