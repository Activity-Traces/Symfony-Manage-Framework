<?php

namespace App\Repository;

use App\Entity\AssociateRefComp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AssociateRefComp|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociateRefComp|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociateRefComp[]    findAll()
 * @method AssociateRefComp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociateRefCompRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AssociateRefComp::class);
    }

    // /**
    //  * @return AssociateRefComp[] Returns an array of AssociateRefComp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssociateRefComp
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
