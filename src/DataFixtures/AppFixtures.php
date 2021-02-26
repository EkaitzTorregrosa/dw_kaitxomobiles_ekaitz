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
            
            $user = new Users();
            $user->setUser("user_$i");
            $user->setPass("123");
            $manager->persist($user);
            
            $mobile = new Mobiles();
            $mobile->setName($mobileFaker->name);
            $mobile->setDescription($mobileFaker->sentence);
            $mobile->setUrlPicture("http://lorempixel.com/g/400/200");
            $mobile->setPrice($mobileFaker->numberBetween($min=200, $max=1500));
            $mobile->setUsers($user);
            $manager->persist($mobile);
        }
        $manager->flush();
    }
}
