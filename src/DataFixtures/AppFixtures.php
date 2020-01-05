<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Practice;
use App\Entity\Candidate;
use App\Entity\DetailSize;
use App\Entity\Evaluation;
use App\Repository\PracticeRepository;
use App\Repository\CandidateRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $faker;
    private $cr;
    private $pr;
    private $passwordEncoder;

    public function __construct(CandidateRepository $CandidateREpository, PracticeRepository $practiceRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->faker = Factory::create('fr_CH');
        $this->cr = $CandidateREpository;
        $this->pr = $practiceRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /* Chargement des exercices */
        $this->loadUser($manager);

        /* Chargement des exercices */
        $this->loadPractice($manager);

        /* Chargement des candidats*/
        $this->loadCandidat($manager);

        /* Chargement des evaluations*/
        $this->loadEvaluation($manager);

        /* Chargement des tailles*/
        $this->loadDetailSize($manager);
    }


    private function loadUser(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, '1234'));
        $manager->persist($user);
        $manager->flush();
    }

    private function loadPractice(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $practice = new Practice();
            $practice->setName('Exercice ' . $i);
            $manager->persist($practice);
        }
        $manager->flush();
    }

    private function loadCandidat(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $candidat = new Candidate();
            $candidat->setName($this->faker->lastName);
            $candidat->setFirstname($this->faker->firstName());
            $candidat->setMobile($this->faker->mobileNumber);
            $manager->persist($candidat);
        }
        $manager->flush();
    }

    private function loadEvaluation(ObjectManager $manager)
    {
        $candidates = $this->cr->findAll();
        $practices = $this->pr->findAll();

        foreach ($candidates as $candidate) {
            foreach ($practices as $practice) {
                $evaluation = new Evaluation();
                $evaluation->setCandidate($candidate);
                $evaluation->setPractice($practice);
                $manager->persist($evaluation);
            }
        }
        $manager->flush();
    }

    private function loadAndFlushDS(ObjectManager $manager, string $value)
    {
        $detaiSize = new DetailSize();
        $detaiSize->setName($value);
        $manager->persist($detaiSize);
        $manager->flush();
    }

    private function loadDetailSize(ObjectManager $manager)
    {
        $this->loadAndFlushDS($manager, '76 L');
        $this->loadAndFlushDS($manager, '80 S');
        $this->loadAndFlushDS($manager, '80 M');
        $this->loadAndFlushDS($manager, '80 L');
        $this->loadAndFlushDS($manager, '80 XL');
        $this->loadAndFlushDS($manager, '84 S');
        $this->loadAndFlushDS($manager, '84 M');
        $this->loadAndFlushDS($manager, '84 L');
        $this->loadAndFlushDS($manager, '84 XL');
        $this->loadAndFlushDS($manager, '88 S');
        $this->loadAndFlushDS($manager, '88 M');
        $this->loadAndFlushDS($manager, '88 L');
        $this->loadAndFlushDS($manager, '88 XL');
        $this->loadAndFlushDS($manager, '92 M');
        $this->loadAndFlushDS($manager, '92 L');
        $this->loadAndFlushDS($manager, '92 XL');
        $this->loadAndFlushDS($manager, '96 M');
        $this->loadAndFlushDS($manager, '96 L');
        $this->loadAndFlushDS($manager, '96 XL');
        $this->loadAndFlushDS($manager, '100 M');
        $this->loadAndFlushDS($manager, '100 L');
        $this->loadAndFlushDS($manager, '100 XL');
        $this->loadAndFlushDS($manager, '104 L');
        $this->loadAndFlushDS($manager, '104 XL');
        $this->loadAndFlushDS($manager, '112 L');
        $this->loadAndFlushDS($manager, '112 XL');
    }
}
