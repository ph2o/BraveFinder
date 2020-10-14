<?php

namespace App\Repository;

use App\Entity\Interviewer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Interviewer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Interviewer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Interviewer[]    findAll()
 * @method Interviewer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterviewerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Interviewer::class);
    }

    // /**
    //  * @return Interviewer[] Returns an array of Interviewer objects
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
    public function findOneBySomeField($value): ?Interviewer
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
