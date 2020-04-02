<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Comments;


class JeuxdeTest extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker= \Faker\Factory::create();

        for ($i=1; $i<=3; $i++) { 
            $category = new Categorie();
            
            $category->setTitre($faker->sentence())
                     ->setDescription($faker->paragraph());
                     

            $manager->persist($category);
      
            for ($j=1; $j<=6; $j++) { 

                $produit = new Articles();
                $x=join($faker->paragraphs(5),'<p>');
                $produit->setTitre($faker->sentence())
                        ->setDescription($x)
                        ->setImage($faker->imageUrl())
                        ->setCreatedtAt($faker->DateTimeBetween('-6 months'))
                        ->setCategorie($category);
                
                $manager->persist($produit);

                for ($k=1; $k<=3; $k++) {
                    $comment = new Comments();
                    $x=join($faker->paragraphs(5),'<p>');
                    $comment->setTitre($faker->sentence())

                            ->setcommentaire($x)
                            ->setHasArticle($produit)
                            ->setCreatedAt($faker->DateTimeBetween('-6 months'));
                            
                    $manager->persist($comment);



                }
            }
            
        }
        $manager->flush();

    }
}
