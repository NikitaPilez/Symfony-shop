<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [];
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            array_push($categories,$category);
            $manager->persist($category);
        }

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setCategory($categories[mt_rand(1,4)]);
            $product->setName($faker->word);
            $product->setColor($faker->word);
            $product->setPhoto('https://picsum.photos/id/' . mt_rand(1,100) . '/600/400');
            $product->setPrice(mt_rand(100,300));
            $product->setCount(mt_rand(1, 10));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
