<?php

namespace App\DataFixtures;

use app\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 5; $i++) { 
            $destination = new Destination();
            $destination->setNom('Destination '.$i)
                        ->setVille('Ville '.$i)
                        ->setPays('Pays '.$i)
                        ->setDescription('Description de la destination '.$i)
                        ->setPrix(100)
                        ->setDevise('EUR')
                        ->setDateCreation(new \DateTime('2023-05-01'))
                        ->setDateMAJ(new \DateTime('2023-05-20'));
            $manager->persist($destination);
        }

        $manager->flush();
    }
}
