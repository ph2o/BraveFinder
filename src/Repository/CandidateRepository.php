<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\CandidateSearch;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Doctrine\Persistence\ManagerRegistry;
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
        // Création des titres
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Candidats ' . date('Y'));
        $sheet->getCell('A1')->setValue($this->translator->trans('N°'));
        $sheet->getCell('B1')->setValue($this->translator->trans('Retenu'));
        $sheet->getCell('C1')->setValue($this->translator->trans('PathWay'));
        $sheet->getCell('D1')->setValue($this->translator->trans('Name'));
        $sheet->getCell('E1')->setValue($this->translator->trans('Firstname'));
        $sheet->getCell('F1')->setValue($this->translator->trans('Title'));
        $sheet->getCell('G1')->setValue($this->translator->trans('Function'));
        $sheet->getCell('H1')->setValue($this->translator->trans('Grade'));
        $sheet->getCell('I1')->setValue($this->translator->trans('Station'));
        $sheet->getCell('J1')->setValue($this->translator->trans('Birthdate'));
        $sheet->getCell('K1')->setValue($this->translator->trans('Mobile'));
        $sheet->getCell('L1')->setValue($this->translator->trans('Phone'));
        $sheet->getCell('M1')->setValue($this->translator->trans('Street'));
        $sheet->getCell('N1')->setValue($this->translator->trans('HouseNumber'));
        $sheet->getCell('O1')->setValue($this->translator->trans('Zip'));
        $sheet->getCell('P1')->setValue($this->translator->trans('City'));
        $sheet->getCell('Q1')->setValue($this->translator->trans('Mail'));
        $sheet->getCell('R1')->setValue($this->translator->trans('Marital Status'));
        $sheet->getCell('S1')->setValue($this->translator->trans('Social Number'));
        $sheet->getCell('T1')->setValue($this->translator->trans('origin Name'));
        $sheet->getCell('U1')->setValue($this->translator->trans('Education'));
        $sheet->getCell('V1')->setValue($this->translator->trans('Iban'));
        $sheet->getCell('W1')->setValue($this->translator->trans('BankName'));
        $sheet->getCell('X1')->setValue($this->translator->trans('RubberBoots'));
        $sheet->getCell('Y1')->setValue($this->translator->trans('RangerBoots'));
        $sheet->getCell('Z1')->setValue($this->translator->trans('FireGloves'));
        $sheet->getCell('AA1')->setValue($this->translator->trans('WaitingPants'));
        $sheet->getCell('AB1')->setValue($this->translator->trans('FirePants'));
        $sheet->getCell('AC1')->setValue($this->translator->trans('Sweat'));
        $sheet->getCell('AD1')->setValue($this->translator->trans('Teeshirt'));
        $sheet->getCell('AE1')->setValue($this->translator->trans('FireJacket'));
        $sheet->getCell('AF1')->setValue($this->translator->trans('HeadCircumference'));

        $candidates = $this->findAll();
        $i = 2;

        // Crétion des infos
        foreach ($candidates as $candidate) {
            $sheet->getCell('A' . $i)->setValue($i - 1);
            $sheet->getCell('B' . $i)->setValue($this->translator->trans($candidate->getEngaged()));
            $sheet->getCell('C' . $i)->setValue($candidate->getPathWay());
            $sheet->getCell('D' . $i)->setValue($candidate->getName());
            $sheet->getCell('E' . $i)->setValue($candidate->getFirstname());
            $sheet->getCell('F' . $i)->setValue($candidate->getTitle());
            $sheet->getCell('G' . $i)->setValue('Recrue SPV');
            $sheet->getCell('H' . $i)->setValue('Rec');
            $sheet->getCell('I' . $i)->setValue($candidate->getStation());
            if ($candidate->getBirthdate()) {
                $sheet->getCell('J' . $i)->setValue($candidate->getBirthdate()->format('d.m.Y'));
            }
            $sheet->getCell('K' . $i)->setValue($candidate->getMobile());
            $sheet->getCell('L' . $i)->setValue($candidate->getPhone());
            $sheet->getCell('M' . $i)->setValue($candidate->getStreet());
            $sheet->getCell('N' . $i)->setValue($candidate->getHouseNumber());
            $sheet->getCell('O' . $i)->setValue($candidate->getZip());
            $sheet->getCell('P' . $i)->setValue($candidate->getCity());
            $sheet->getCell('Q' . $i)->setValue($candidate->getMail());
            $sheet->getCell('R' . $i)->setValue($candidate->getMaritalStatus());
            $sheet->getCell('S' . $i)->setValue($candidate->getSocialNumber());
            $sheet->getCell('T' . $i)->setValue($candidate->getOriginName());
            $sheet->getCell('U' . $i)->setValue($candidate->getEducation());
            $sheet->getCell('V' . $i)->setValue($candidate->getIban());
            $sheet->getCell('W' . $i)->setValue($candidate->getBankName());
            $sheet->getCell('X' . $i)->setValue($candidate->getRubberBoots());
            $sheet->getCell('Y' . $i)->setValue($candidate->getRangerBoots());
            $sheet->getCell('Z' . $i)->setValue($candidate->getFireGloves());
            $sheet->getCell('AA' . $i)->setValue($candidate->getWaitingPants());
            $sheet->getCell('AB' . $i)->setValue($candidate->getFirePants());
            $sheet->getCell('AC' . $i)->setValue($candidate->getSweat());
            $sheet->getCell('AD' . $i)->setValue($candidate->getTeeshirt());
            $sheet->getCell('AE' . $i)->setValue($candidate->getFireJacket());
            $sheet->getCell('AF' . $i)->setValue($candidate->getHeadCircumference());
            $i++;
        }

        // Titre de colonnes en vertical
        $sheet->getStyle('X1:AF1')->getAlignment()->setTextRotation(90);

        // AutoSize sur toutes les colonnes
        $colDims = $sheet->getColumnDimensions('A:AF');
        foreach ($colDims as $col) {
            $col->setAutoSize(true);
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
