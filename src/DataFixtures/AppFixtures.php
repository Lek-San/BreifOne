<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Category;

require_once 'vendor/autoload.php';

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
        
            $product->setProductName('Produit ' . $i)
                    ->setProductDesc('C\'est la description du produit ' . $i)
                    ->setProductPrice(mt_rand(0.59, 99.99));
            
            $manager->persist($product);
        }

        for ($i = 1; $i < 10; $i++) {
            $category = new Category();
        
            $category->setCategoryName('Categorie ' . $i);
            
            $manager->persist($category);
        }

        $manager->flush();
    }
}
