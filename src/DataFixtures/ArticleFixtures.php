<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $article = new Article();
            $article
                ->setTitle("Article numéro $i")
                ->setContent("<p>Contenu de l'article $i</p>")
                ->setCreatedAt(new DateTime())
                ->setImage("http://picsum.photos/250/150")
            ;
            
            $manager->persist($article);
        }
        $manager->flush();        
    }
}
