<?php

namespace App\Repository;

use App\Entity\ClaireExerciseModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClaireExerciseModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClaireExerciseModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClaireExerciseModel[]    findAll()
 * @method ClaireExerciseModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClaireExerciseModel::class);
    }

    // /**
    //  * @return ClaireExerciseModel[] Returns an array of ClaireExerciseModel objects
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
    public function findOneBySomeField($value): ?ClaireExerciseModel
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
