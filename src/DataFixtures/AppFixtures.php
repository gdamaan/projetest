<?php

namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\Panier;
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
        $articles=[];
        for ($i = 0; $i <= 50; $i++) {
            $article = new Article();
            $article->setUrl($this->faker->url);
            $article->setTitre($this->faker->word);
            $article->setResume($this->faker->text(99));
            $dateEnre = new \DateTime($this->faker->date);
            $article->setDateEnre($dateEnre);
            $articles[] =$article;
            $manager->persist($article);
        }


        for ($i=0; $i <= 20; $i++){
            $panier =new Panier();
            for ($k =0 ;$k< mt_rand(1,5);$k++){
                $panier->addListeArticle($articles[mt_rand(0,count($articles)-1)]);
            }
            $manager->persist($panier);
        }



        $manager->flush();
    }

}
