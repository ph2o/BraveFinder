<?php

namespace App\Repository;

use App\Entity\DetailSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailSize[]    findAll()
 * @method DetailSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailSize::class);
    }

    // /**
    //  * @return DetailSize[] Returns an array of DetailSize objects
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
    public function findOneBySomeField($value): ?DetailSize
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
