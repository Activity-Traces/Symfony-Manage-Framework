<?php

namespace App\Repository;

use App\Entity\Indicateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Indicateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indicateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indicateurs[]    findAll()
 * @method Indicateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndicateursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Indicateurs::class);
    }

    // /**
    //  * @return Indicateurs[] Returns an array of Indicateurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indicateurs
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
