<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use App\Repository\WishRepository;
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
        $categoriesRepo = $manager->getRepository(Category::class);
        $categories = $categoriesRepo->findAll(); // chercher les categories deja existantes en bdd sinon les creer

     for($i=26; $i <30; $i++)
     {
         $wish = new Wish();
         $wish->setTitle("visiter la ville ".$i);
         $wish->setDescription($generator->text(200));
         $wish->setAuthor($generator->lastName);
         $wish->setDateCreated($generator->dateTime());
         $wish->setIsPublished($generator->numberBetween(0,1));
         $wish->setNote($generator->randomFloat(1,0,10));
         $wish->setCategory($generator->randomElement($categories));
         $manager->persist($wish);

     }

        $manager->flush();
    }
}
