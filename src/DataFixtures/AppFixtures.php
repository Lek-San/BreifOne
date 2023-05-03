<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Category;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
        
            $product->setProductName($generator->lastName)
                    ->setProductDesc($generator->text)
                    ->setProductPrice($generator->biasedNumberBetween(0.59, 99.99));
            
            $manager->persist($product);
        }

        for ($i = 1; $i < 10; $i++) {
            $category = new Category();
        
            $category->setCategoryName($generator->firstName);
            
            $manager->persist($category);
        }

        $manager->flush();
    }
}
