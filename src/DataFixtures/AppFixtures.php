<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $generator= Faker\Factory::create('fr_FR');

     for($i=0; $i <20; $i++)
     {
         $wish = new Wish();
         $wish->setTitle("visiter la ville ".$i);
         $wish->setDescription($generator->text(200));
         $wish->setAuthor($generator->lastName);
         $wish->setDateCreated($generator->dateTime());
         $wish->setIsPublished($generator->numberBetween(0,1));
         $wish->setNote($generator->randomFloat(1,0,10));
         $manager->persist($wish);

     }

        $manager->flush();
    }
}
