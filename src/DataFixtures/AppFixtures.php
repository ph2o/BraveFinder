<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Practice;
use App\Entity\Candidate;
use App\Entity\DetailSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_CH');
    }

    public function load(ObjectManager $manager)
    {
        /* Chargement des exercices */
        $this->loadPractice($manager);

        /* Chargement des candidats*/
        $this->loadCandidat($manager);

        /* Chargement des tailles*/
        $this->loadDetailSize($manager);
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
