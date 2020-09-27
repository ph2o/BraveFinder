<?php

namespace App\Repository;

use App\Entity\CsvFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CsvFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method CsvFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method CsvFile[]    findAll()
 * @method CsvFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CsvFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CsvFile::class);
    }

    // /**
    //  * @return CsvFile[] Returns an array of CsvFile objects
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
    public function findOneBySomeField($value): ?CsvFile
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
