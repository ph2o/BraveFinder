<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\CandidateSearch;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Candidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidate[]    findAll()
 * @method Candidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateRepository extends ServiceEntityRepository
{
    private $translator;

    public function __construct(ManagerRegistry $registry, TranslatorInterface  $trans)
    {
        parent::__construct($registry, Candidate::class);
        $this->translator = $trans;
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

    /**
     * Retourne les données pour extraction xlsx
     *
     * @return array
     */
    public function getXlsxData(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Candidats SPV');
        $sheet->getCell('A1')->setValue($this->translator->trans('Name'));
        $sheet->getCell('B1')->setValue($this->translator->trans('Firstname'));
        $sheet->getCell('C1')->setValue($this->translator->trans('Unit'));
        $sheet->getCell('D1')->setValue($this->translator->trans('Grade'));
        $sheet->getCell('E1')->setValue($this->translator->trans('Phone'));
        $sheet->getCell('F1')->setValue($this->translator->trans('Mobile'));
        $sheet->getCell('G1')->setValue($this->translator->trans('Birthdate'));
        $sheet->getCell('H1')->setValue($this->translator->trans('Street'));
        $sheet->getCell('I1')->setValue($this->translator->trans('HouseNumber'));
        $sheet->getCell('J1')->setValue($this->translator->trans('Zip'));
        $sheet->getCell('K1')->setValue($this->translator->trans('City'));
        $sheet->getCell('L1')->setValue($this->translator->trans('Mail'));
        $sheet->getCell('M1')->setValue($this->translator->trans('MailPro'));
        $sheet->getCell('N1')->setValue($this->translator->trans('RubberBoots'));
        $sheet->getCell('O1')->setValue($this->translator->trans('RangerBoots'));
        $sheet->getCell('P1')->setValue($this->translator->trans('FireGloves'));
        $sheet->getCell('Q1')->setValue($this->translator->trans('WaitingPants'));
        $sheet->getCell('R1')->setValue($this->translator->trans('FirePants'));
        $sheet->getCell('S1')->setValue($this->translator->trans('Sweat'));
        $sheet->getCell('T1')->setValue($this->translator->trans('Teeshirt'));
        $sheet->getCell('U1')->setValue($this->translator->trans('FireJacket'));

        $candidates = $this->findAll();
        $i = 2;
        foreach ($candidates as $candidate) {
            $sheet->getCell('A' . $i)->setValue($candidate->getName());
            $sheet->getCell('B' . $i)->setValue($candidate->getFirstname());
            $sheet->getCell('C' . $i)->setValue('Recrue SPV');
            $sheet->getCell('D' . $i)->setValue('Recrue');
            $sheet->getCell('E' . $i)->setValue($candidate->getPhone());
            $sheet->getCell('F' . $i)->setValue($candidate->getMobile());
            $sheet->getCell('G' . $i)->setValue($candidate->getBirthdate());
            $sheet->getCell('H' . $i)->setValue($candidate->getStreet());
            $sheet->getCell('I' . $i)->setValue($candidate->getHouseNumber());
            $sheet->getCell('J' . $i)->setValue($candidate->getZip());
            $sheet->getCell('K' . $i)->setValue($candidate->getCity());
            $sheet->getCell('L' . $i)->setValue($candidate->getMail());
            $sheet->getCell('M' . $i)->setValue($candidate->getMailPro());
            $sheet->getCell('N' . $i)->setValue($candidate->getRubberBoots());
            $sheet->getCell('O' . $i)->setValue($candidate->getRangerBoots());
            $sheet->getCell('P' . $i)->setValue($candidate->getFireGloves());
            $sheet->getCell('Q' . $i)->setValue($candidate->getWaitingPants());
            $sheet->getCell('R' . $i)->setValue($candidate->getFirePants());
            $sheet->getCell('S' . $i)->setValue($candidate->getSweat());
            $sheet->getCell('T' . $i)->setValue($candidate->getTeeshirt());
            $sheet->getCell('U' . $i)->setValue($candidate->getFireJacket());
            $i++;
        }
        return $spreadsheet;
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

    /**
     * Get the value of translator
     *
     * @return  mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Set the value of translator
     *
     * @param   mixed  $translator  
     *
     * @return  self
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }
}
