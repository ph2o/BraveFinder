<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\CandidateSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Candidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidate[]    findAll()
 * @method Candidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidate::class);
    }

    public function findAllQuery(CandidateSearch $search)
    {
        $query = $this->createQueryBuilder('c');

        if ($search->getCandidateSearch()) {
            $query
                ->orWhere('c.name like :val')
                ->orWhere('c.firstname like :val')
                ->setParameter('val', $search->getCandidateSearch() . '%');
        }
        return $query->getQuery()
            ->getResult();
    }

    public function findAllOnSiteQuery(CandidateSearch $search)
    {
        $query = $this->createQueryBuilder('c')
            ->andWhere('c.onSite = 1 ');

        if ($search->getCandidateSearch()) {
            $query
                ->andWhere('c.name like :val or c.firstname like :val')
                ->setParameter('val', $search->getCandidateSearch() . '%');
        }
        return $query->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Candidate[] Returns an array of Candidate objects
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
    public function findOneBySomeField($value): ?Candidate
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
