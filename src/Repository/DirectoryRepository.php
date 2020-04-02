<?php

namespace App\Repository;

use App\Entity\Directory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Directory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Directory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Directory[]    findAll()
 * @method Directory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirectoryRepository extends ServiceEntityRepository
{


    public function findmodelsbydirectory($repid)
{
    return $this->createQueryBuilder('p')
        // p.model refers to the "model" property on directory entity
        ->innerJoin('p.model', 'c')
        // selects all the models related to this directory and return the result
        ->addSelect('c')
        ->andWhere('p.id = :id')
        ->setParameter('id', $repid)
        ->getQuery()
        ->getOneOrNullResult();
}


    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Directory::class);
    }

    // /**
    //  * @return Directory[] Returns an array of Directory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Directory
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
