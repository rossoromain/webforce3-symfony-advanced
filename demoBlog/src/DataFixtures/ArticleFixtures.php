<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 10; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence(3));
            $manager->persist($category);

            for ($j = 0; $j < mt_rand(4, 6); $j++) {
                $article = new Article();
                $content = '<p>' . join('<p></p>', $faker->paragraphs(5)) . '</p>';

                $article
                    ->setTitle($faker->sentence(3))
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category)
                ;
                $manager->persist($article);

                for ($k = 0; $k < mt_rand(5, 10); $k++) {
                    $comment = new Comment();
                    $content = '<p>' . join('<p></p>', $faker->paragraphs(2)) . '</p>';
                    $days = (new DateTime())->diff($article->getCreatedAt())->days;
                    $comment
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween("-$days days"))
                        ->setAuthor($faker->name())
                        ->setArticle($article)
                    ;
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }
}
