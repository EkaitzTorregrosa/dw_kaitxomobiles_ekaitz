<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use App\Entity\Mobiles;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
        // Creating 20 job offers
        for ($i = 0; $i < 6; $i++) {
            $mobileFaker = Faker\Factory::create();
            // Employeer
            $user = new Users();
            $user->setUser("user_$i");
            $user->setPass("123");
            $manager->persist($user);
            // Offer
            $mobile = new Mobiles();
            $mobile->setName($mobileFaker->name);
            $mobile->setDescription($mobileFaker->sentence);
            $mobile->setUrlPicture($mobileFaker->imageUrl($width=640, $heigth=480));
            $mobile->setPrice($mobileFaker->numberBetween($min=200, $max=1500));
            $mobile->setUsers($user);
            $manager->persist($mobile);
        }
        $manager->flush();
    }
}
