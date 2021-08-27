<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\Evaluation;
use App\Entity\EvaluationSearch;
use Doctrine\Persistence\ManagerRegistry;
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

    /**
     * Recherche toutes les évals
     *
     * @param EvaluationSearch $search
     *
     * @return void
     */
    public function findAllQuery(EvaluationSearch $search)
    {
        $query = $this->createQueryBuilder('e');

        $andWhere = 'e.candidate in (
            select c.id 
              from App\Entity\candidate c 
             where c.onSite = 1 ';

        if ($search->getCandidate()) {
            $andWhere .= ' and ((c.name like :val1) or (c.firstname like :val1)) ';
            $query->setParameter('val1', $search->getCandidate().'%');
        }
        $andWhere .= ')';

        $query->AndWhere($andWhere);

        if ($search->getPractice()) {
            $query
                ->AndWhere('e.practice in (select p.id
                                                from App\Entity\practice p
								               where p.name like :val2)')
                ->setParameter('val2', $search->getPractice().'%');
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
     *
     * @return void
     */
    public function addNewEvaluations()
    {
        $this->getEntityManager()->getConnection()->executeUpdate('
            insert 
              into evaluation (candidate_id, practice_id,created_at, updated_at) 
                   select c.id, p.id, now(), now()
                     from candidate c, practice p
                    where concat(CONVERT(c.id,char), "*", convert(p.id,char)) 
				      not in ( select concat(CONVERT(e.candidate_id,char), "*", convert(e.practice_id,char)) 
							     from evaluation e)
            ');
    }

    /**
     * function findAllPracticesForCandidate
     *
     * Recherche toutes les évaluations pour un candidat (hors entretien)
     *
     */
    public function findAllPracticesForCandidate(Candidate $candidate)
    {
        $query = $this->createQueryBuilder('e');

        $query->AndWhere('e.candidate = '.$candidate->getId());

        $query->AndWhere('e.practice in (   select p.id 
                                              from App\Entity\practice p 
                                             where p.interview = 0 )');

        return $query->getQuery()
            ->getResult();
    }

    /**
     * @return Evaluation[] Returns an array of Evaluation objects
     */

    public function findOpenEvaluations($role = false, bool $groupBy = true)
    {
        $builder = $this->createQueryBuilder('e')->leftJoin('e.practice', 'p')
            ->andWhere('e.validate = 0');

        if ($role) {
            $builder->andWhere('p.group_allowed = :role')
                ->setParameter('role', $role);
        }

        if ($groupBy) {
            $builder->groupBy('e.candidate');
        }

        return $builder
            ->orderBy('e.id', 'ASC')->getQuery()->getResult();
    }


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
