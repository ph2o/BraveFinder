<?php

namespace App\Repository;

use App\Entity\PathWay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PathWay|null find($id, $lockMode = null, $lockVersion = null)
 * @method PathWay|null findOneBy(array $criteria, array $orderBy = null)
 * @method PathWay[]    findAll()
 * @method PathWay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PathWayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PathWay::class);
    }

    // /**
    //  * @return PathWay[] Returns an array of PathWay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PathWay
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
