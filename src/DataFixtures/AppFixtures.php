<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Size;
use App\Entity\User;
use App\Entity\Practice;
use App\Entity\Candidate;
use App\Entity\DetailSize;
use App\Entity\Evaluation;
use App\Entity\MaritalStatus;
use App\Entity\MaritalStatut;
use App\Entity\PathWay;
use App\Entity\Station;
use App\Entity\Title;
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

    public function __construct(
        CandidateRepository $CandidateRepository,
        PracticeRepository $practiceRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->faker = Factory::create('fr_CH');
        $this->cr = $CandidateRepository;
        $this->pr = $practiceRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /* Chargement des utilisateurs */
        $this->loadUser($manager);

        /* Chargement des tailles détaillées*/
        $this->loadDetailSize($manager);

        /* Chargement des tailles*/
        $this->loadSize($manager);

        /* Chargement des exercices */
        $this->loadPractice($manager);

        /* Chargement des candidats*/
        $this->loadCandidat($manager);

        /* Chargement des evaluations*/
        $this->loadEvaluation($manager);

        /* Chargement des statut marital*/
        $this->loadMaritalStatut($manager);

        /* Chargement des DPS*/
        $this->loadStation($manager);

        /* Chargement des filières*/
        $this->loadPathWay($manager);

        /* Chargement des formules de politesses*/
        $this->loadTitle($manager);
    }

    private function loadPracticeDetail(ObjectManager $manager, string $practicename, string $groupallowed, int $interview = 0)
    {
        $practice = new Practice();
        $practice->setName($practicename);
        $practice->setGroupAllowed($groupallowed);
        $practice->setInterview($interview);
        $manager->persist($practice);
        $manager->flush();
    }

    private function loadPractice(ObjectManager $manager)
    {
        $this->loadPracticeDetail($manager, 'Endurance', 'ROLE_ENDURANCE');
        $this->loadPracticeDetail($manager, 'Claustrophobie', 'ROLE_CLOSTROPHOBIE');
        $this->loadPracticeDetail($manager, 'Vertige', 'ROLE_VERTIGE');
        $this->loadPracticeDetail($manager, 'Force physique', 'ROLE_FORCE');
        $this->loadPracticeDetail($manager, 'Confiance', 'ROLE_CONFIANCE');
        $this->loadPracticeDetail($manager, 'Entretien', 'ROLE_ENTRETIEN', 1);
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

    private function loadAndFlushSize(ObjectManager $manager, string $value)
    {
        $detai = new Size();
        $detai->setName($value);
        $manager->persist($detai);
        $manager->flush();
    }

    private function loadSize(ObjectManager $manager)
    {
        $this->loadAndFlushSize($manager, 'XS');
        $this->loadAndFlushSize($manager, 'S');
        $this->loadAndFlushSize($manager, 'M');
        $this->loadAndFlushSize($manager, 'L');
        $this->loadAndFlushSize($manager, 'XL');
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
        $this->loadUserDetail($manager, 'claustro', '1234', ['ROLE_CLOSTROPHOBIE']);
        $this->loadUserDetail($manager, 'endurance', '1234', ['ROLE_ENDURANCE']);
        $this->loadUserDetail($manager, 'force', '1234', ['ROLE_FORCE']);
        $this->loadUserDetail($manager, 'entretien', '1234', ['ROLE_ENTRETIEN'], 1);
        $this->loadUserDetail($manager, 'vertige', '1234', ['ROLE_VERTIGE']);
        $this->loadUserDetail($manager, 'confiance', '1234', ['ROLE_CONFIANCE']);
    }

    private function CreateFlushMaritalStatut(ObjectManager $manager, string $statut)
    {
        $obj = new MaritalStatus();
        $obj->setName($statut);
        $manager->persist($obj);
        $manager->flush();
    }
    private function loadMaritalStatut(ObjectManager $manager)
    {
        $this->CreateFlushMaritalStatut($manager, 'Célibataire/e');
        $this->CreateFlushMaritalStatut($manager, 'Marié/e');
        $this->CreateFlushMaritalStatut($manager, 'Veuf/veuve');
        $this->CreateFlushMaritalStatut($manager, 'Divorcé/e');
        $this->CreateFlushMaritalStatut($manager, 'Non marié/e ');
        $this->CreateFlushMaritalStatut($manager, 'Lié/e par un partenariat enregistré');
        $this->CreateFlushMaritalStatut($manager, 'Partenariat dissous');
        $this->CreateFlushMaritalStatut($manager, 'Inconnu');
    }

    private function CreateFlushStation(ObjectManager $manager, string $statut)
    {
        $obj = new Station();
        $obj->setName($statut);
        $manager->persist($obj);
        $manager->flush();
    }
    private function loadStation(ObjectManager $manager)
    {
        $this->CreateFlushStation($manager, 'DPS1 - La Chaux-de-Fonds');
        $this->CreateFlushStation($manager, 'DPS3 - La Brévine');
        $this->CreateFlushStation($manager, 'DPS3 - Les Brenets');
        $this->CreateFlushStation($manager, 'DPS3 - Les Ponts-de-Martel');
        $this->CreateFlushStation($manager, 'DPS4 - La Chaux-du-Milieu');
        $this->CreateFlushStation($manager, 'DPS4 - La Sagne');
        $this->CreateFlushStation($manager, 'DPS4 - Les Planchettes');
    }
    private function CreateFlushPathWay(ObjectManager $manager, string $statut)
    {
        $obj = new PathWay();
        $obj->setName($statut);
        $manager->persist($obj);
        $manager->flush();
    }
    private function loadPathWay(ObjectManager $manager)
    {
        $this->CreateFlushPathWay($manager, 'Filière A');
        $this->CreateFlushPathWay($manager, 'Filière B');
    }
    private function CreateFlushTitle(ObjectManager $manager, string $statut)
    {
        $obj = new Title();
        $obj->setName($statut);
        $manager->persist($obj);
        $manager->flush();
    }
    private function loadTitle(ObjectManager $manager)
    {
        $this->CreateFlushTitle($manager, 'Monsieur');
        $this->CreateFlushTitle($manager, 'Madame');
    }
}
