<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Practice;
use App\Entity\Candidate;
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
}
