<?php

namespace App\Repository;

use App\Entity\ClaireExerciseStoredExercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClaireExerciseStoredExercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClaireExerciseStoredExercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClaireExerciseStoredExercise[]    findAll()
 * @method ClaireExerciseStoredExercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClaireExerciseStoredExerciseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClaireExerciseStoredExercise::class);
    }

    // /**
    //  * @return ClaireExerciseStoredExercise[] Returns an array of ClaireExerciseStoredExercise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClaireExerciseStoredExercise
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
