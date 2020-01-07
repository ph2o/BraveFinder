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
        $this->loadPractice($manager);

        /* Chargement des candidats*/
        $this->loadCandidat($manager);

        /* Chargement des evaluations*/
        $this->loadEvaluation($manager);

        /* Chargement des tailles*/
        $this->loadDetailSize($manager);

        /* Chargement des utilisateurs */
        $this->loadUser($manager);
    }

    private function loadPracticeDetail(ObjectManager $manager, string $practicename, string $groupallowed)
    {
        $practice = new Practice();
        $practice->setName($practicename);
        $practice->setGroupAllowed($groupallowed);
        $manager->persist($practice);
        $manager->flush();
    }

    private function loadPractice(ObjectManager $manager)
    {
        $this->loadPracticeDetail($manager, 'Accueil', 'ROLE_ACCUEIL');
        $this->loadPracticeDetail($manager, 'Administratif', 'ROLE_SECRETARIAT');
        $this->loadPracticeDetail($manager, 'Test endurance', 'ROLE_ENDURANCE');
        $this->loadPracticeDetail($manager, 'Test clostrophobie', 'ROLE_CLOSTROPHOBIE');
        $this->loadPracticeDetail($manager, 'Test vertige', 'ROLE_VERTIGE');
        $this->loadPracticeDetail($manager, 'Test force physique', 'ROLE_FORCE');
        $this->loadPracticeDetail($manager, 'Test confiance', '');
        $this->loadPracticeDetail($manager, 'Entretien', 'ROLE_ENTRETIEN');
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

    private function loadUserDetail(ObjectManager $manager, string $username, string $mdp, array $roles)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $mdp));
        $manager->persist($user);
        $manager->flush();
    }

    private function loadUser(ObjectManager $manager)
    {
        $this->loadUserDetail($manager, 'admin', '1234', ['ROLE_ADMIN']);

        $this->loadUserDetail($manager, 'accueil', '1234', ['ROLE_ACCUEIL']);
        $this->loadUserDetail($manager, 'secretariat', '1234', ['ROLE_SECRETARIAT']);
        $this->loadUserDetail($manager, 'mesure', '1234', ['ROLE_MESURE']);
        $this->loadUserDetail($manager, 'clostro', '1234', ['ROLE_CLOSTROPHOBIE']);
        $this->loadUserDetail($manager, 'endurance', '1234', ['ROLE_ENDURANCE']);
        $this->loadUserDetail($manager, 'force', '1234', ['ROLE_FORCE']);
        $this->loadUserDetail($manager, 'entretien', '1234', ['ROLE_ENTRETIEN']);
        $this->loadUserDetail($manager, 'vertige', '1234', ['ROLE_VERTIGE']);
    }
}
