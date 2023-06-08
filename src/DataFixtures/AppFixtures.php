<?php

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {

        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {


        for ($i = 0; $i <= 50; $i++) {
            $article = new Article();
            $article->setUrl($this->faker->url);
            $article->setTitre($this->faker->word);
            $article->setResume($this->faker->text(99));
            $dateEnre = new \DateTime($this->faker->date);
            $article->setDateEnre($dateEnre);
            $manager->persist($article);
        }



        $manager->flush();
    }

}
