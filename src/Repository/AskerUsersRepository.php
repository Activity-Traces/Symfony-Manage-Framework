<?php

namespace App\Repository;

use App\Entity\AskerUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AskerUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AskerUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AskerUser[]    findAll()
 * @method AskerUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AskerUsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AskerUser::class);
    }

    // /**
    //  * @return AskerUser[] Returns an array of AskerUser objects
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
    public function findOneBySomeField($value): ?AskerUser
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
