<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) { 
            $property=new Property();
            $property->setTitle($faker->words(3,true))
                     ->setDescription($faker->paragraph(2))
                     ->setPrice($faker->numberBetween(1000,100000))
                     ->setSurface($faker->numberBetween(50,1000))
                     ->setBedrooms($faker->numberBetween(1,10))
                     ->setRooms($faker->numberBetween(0,5))
                     ->setCity($faker->city())
                     ->setFloor($faker->numberBetween(0,5))
                     ->setSold(false)
                     ->setPost($faker->postcode())
                     ->setAddress($faker->address())
                     ->setHeat($faker->numberBetween(1,count(Property::HEAD)-1));
            $manager->persist($property);   
        }

        $manager->flush();
    }
}
