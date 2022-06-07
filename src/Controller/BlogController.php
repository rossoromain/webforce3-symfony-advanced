<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenue sur le blog',
            'age' => '16',
        ]);
    }

    #[Route('/blog', name: 'blog')]
    public function index(ArticleRepository $repo): Response
    {

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/blog/show/{id}', name: 'blog_show')]
    public function show(Article $article): Response
    { 
        // show(Article $article) -> créé une instance d'article en settant le param $id de la route automatiquement
        return $this->render('blog/index.html.twig', [
            'article' => $article,
        ]);
    }
}
