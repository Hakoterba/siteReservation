<?php

namespace App\DataFixtures;

use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('ibrahim@gmail.com');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'ibrahim@gmail.com'));
        $admin->setConfirmPassword($this->passwordEncoder->hashPassword($admin, 'ibrahim@gmail.com'));
        $admin->setNom('Tandjigora');
        $admin->setPrenom('ibrahim');
        $admin->setTelephone('0148804098');
        $admin->setRoles(['ROLE_ADMIN']);
        // $product = new Product();
        $manager->persist($admin);

        $faker= Faker\Factory::create('fr_FR');

        for($i = 1 ;$i <= 5; $i++){
            $users = new User();
        $users->setEmail($faker->email);
        $users->setPassword($this->passwordEncoder->hashPassword($users, 'secret'));
        $users->setConfirmPassword($this->passwordEncoder->hashPassword($users, 'secret'));
        $users->setNom($faker->lastName);
        $users->setPrenom($faker->firstName);
        $users->setTelephone($faker->phoneNumber);
        // $product = new Product();
        $manager->persist($users);

        }
        $manager->flush();
    }
}
