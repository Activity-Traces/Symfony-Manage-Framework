<?php

namespace App\SQL;

use Doctrine\Common\Persistence\ObjectManager;

#*****************************************************************************************************************************************************************************#

class sqlRequests {
    // element Referentiel
    // inelement titre

    function find(ObjectManager $manager, $search, $entity, $EntityElement, $user){
        
        if($entity=='ClaireExerciseModel')
            $sql="SELECT p FROM App\Entity\\$entity p where (p.".$EntityElement." LIKE :pm2 ) and ( p.author in (select d From App\Entity\AskerUser d where d.id like :pm3))";
        else
            $sql="SELECT p FROM App\Entity\\$entity p where (p.".$EntityElement." LIKE :pm2 ) and ( p.user in (select d From App\Entity\User d where d.id like :pm3))";
        $query= $manager->createQuery($sql)      
                        ->setParameters(array('pm2'=>'%'.$search.'%','pm3'=>'%'.$user.'%' )); 

        $result = $query->getResult();
        return ($result);
        
    }     

#*****************************************************************************************************************************************************************************#

    function deleteAll(ObjectManager $manager,$entity, $user){

        if ($entity =='User') {
            $sql="DELETE FROM App\Entity\\Competence p where p.user in (select d From App\Entity\User d where d.username <> 'admin' )";
            $manager->createQuery($sql)->execute();

            $sql="DELETE FROM App\Entity\\Referentiel p where p.user in (select d From App\Entity\User d where d.username <> 'admin' )";
            $manager->createQuery($sql)->execute();

            $sql="DELETE FROM App\Entity\\User p where p.username <>'admin' ";
            $manager->createQuery($sql)->execute();

    
        }
        else
            $sql="DELETE FROM App\Entity\\$entity p where p.user in (select d From App\Entity\User d where d.id=" . $user->getId().")";
        $manager->createQuery($sql)
                ->execute();

    }

#*****************************************************************************************************************************************************************************#

    function findAnswers(ObjectManager $manager, $model){


        $sql="SELECT p FROM App\Entity\\ClaireExerciseAnswer p  WHERE ( p.createdAt > :pm) 
        and (p.attempt in 
                (select d.id from  App\Entity\\ClaireExerciseAttempt d where 
                
                d.exercise in 
                    (
                        select h.id from App\Entity\\ClaireExerciseStoredExercise h
                        where h.exerciseModel = :pm1
                    )
                )
            )
        
        ";

        $query= $manager->createQuery($sql)      
                        ->setParameters(array('pm1'=>$model, 'pm'=>1514764800))
                        ; 
                        
        $result = $query->getResult();

        return ($result);
      

    }



    function findAllAnswers(ObjectManager $manager, $type){

        $sql="SELECT p FROM App\Entity\\ClaireExerciseAnswer p  WHERE ( p.createdAt > :pm) 
        and (p.item in 
                (select d.id from  App\Entity\\ClaireExerciseItem d where 
                
                d.type = :pm2 ))
               
        
        ";

        $query= $manager->createQuery($sql)      
                        ->setParameters(array('pm2'=>$type, 'pm'=>1514764800))
                        ; 
        $result = $query->getResult();

                      
        return ($result);
      

    }


    #*****************************************************************************************************************************************************************************#

    function finditemswithoutAnswers(ObjectManager $manager, $model){


        $sql=
            "SELECT p FROM App\Entity\\ClaireExerciseAttempt p  
             WHERE ( p.id not in (select IDENTITY(d.attempt) from App\Entity\\ClaireExerciseAnswer d) )
            
            
            and (
            p.exercise in 
            (
                select h.id from App\Entity\\ClaireExerciseStoredExercise h
                        where h.exerciseModel = :pm1
            )
            )";

           

        $query= $manager->createQuery($sql)      
                        ->setParameters(array('pm1'=>$model))
                        ; 
                        
        $result = $query->getResult();

        return ($result);
      

    }




}
  