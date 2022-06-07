<?php

namespace App\DataFixtures;

use App\Entity\Collegue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CollegueFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 11; $i++) {
            $collegue = new Collegue();
            $collegue
                ->setFirstname("prenom$i")
                ->setName("nom$i")
                ->setWages(rand(1200, 5000));
            $manager->persist($collegue);
        }
        $manager->flush();
    }
}
