<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        for ($i=0;$i<=50;$i++) {
            $article = new Article();
            $article->setUrl("https://www.amazon.fr/housse-mfa-pour-echo-pop/dp/B0BLL3KLMK/ref=sr_1_1?qid=1685633127&refinements=p_n_shipping_option-bin%3A2019350031&s=digital-text&sr=1-1");
            $article->setTitre("Article numéro : " . $i);
            $dateEnre = new \DateTime('now');
            $article->setDateEnre($dateEnre);
            $manager->persist($article);
        }



        $manager->flush();
    }
}
