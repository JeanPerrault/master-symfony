<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i < 101; $i++) {
            $product = new Product();
             $product->setName('iPhone '.$i);
             $product->setDescription('Un iPhone '.$i);
             $product->setPrice(rand(10,1000)*100);
             $manager->persist($product);

        }
        $manager->flush();
    }
}
