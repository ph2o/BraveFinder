<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\Evaluation;
use App\Entity\EvaluationSearch;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Evaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evaluation[]    findAll()
 * @method Evaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class EvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evaluation::class);
    }

    public function findAllQuery(EvaluationSearch $search)
    {
        $query = $this->createQueryBuilder('e');


        if ($search->getCandidate()) {
            $query
                ->AndWhere('e.candidate in (select c.id 
                                                 from App\Entity\candidate c 
									            where (c.name like :val1
                                                   or c.firstname like :val1))')
                ->setParameter('val1', $search->getCandidate() . '%');
        }


        if ($search->getPractice()) {
            $query
                ->AndWhere('e.practice in (select p.id
                                                from App\Entity\practice p
								               where p.name like :val2)')
                ->setParameter('val2', $search->getPractice() . '%');
        }
        return $query->getQuery()
            ->getResult();
    }


    /**
     * addNewEvaluations function
     *
     * Complète les évaluations 
     * 
     * @param Candidate $candidate
     * @return void
     */
    public function addNewEvaluations()
    {
        $this->getEntityManager()->getConnection()->executeUpdate('
            insert 
              into evaluation (candidate_id, practice_id) 
                   select c.id, p.id
                     from candidate c, practice p
                    where concat(CONVERT(c.id,char), "*", convert(p.id,char)) 
				      not in ( select concat(CONVERT(e.candidate_id,char), "*", convert(e.practice_id,char)) 
							     from evaluation e)
            ');
    }

    // /**
    //  * @return Evaluation[] Returns an array of Evaluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evaluation
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
