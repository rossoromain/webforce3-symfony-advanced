<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/blog/view/{id}', name: 'blog_view')]
    // associe $article à nul si l'id n'existe pas
    public function view(Article $article = null): Response
    {
        // view(Article $article) -> créé une instance d'article en settant le param $id de la route automatiquement
        if (!$article) {
            return $this->NotFound404();
        }

        return $this->render('blog/view.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/blog/add', name: 'blog_add')]
    #[Route('/blog/edit/{id}', name: 'blog_edit')]
    // associe $article à nul si l'id n'existe pas
    // la classe request contient toutes les données véhiculées par les superglobales ($_xxxxx)
    public function form(Request $request, EntityManagerInterface $manager, Article $article = null): Response
    {
        if (!$article) {
            $article = new Article();
            $article->setCreatedAt(new DateTime()); // set le champs createAt
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) { // si le formulaire est soumis et valide           
            $manager->persist($article); // prépare insertion
            $manager->flush(); // insert
            return $this->redirectToRoute('blog_view', [
                'id' => $article->getId()
            ]);
        }

        return $this->renderForm('blog/form.html.twig', [
            'formArticle' => $form
        ]);
    }

    #[Route('/404NotFound', name: '404NotFound')]
    // associe $article à nul si l'id n'existe pas
    public function NotFound404(): Response
    {
        return $this->render('404.html.twig', []);
    }

    private function clean($user_entry) {
        $strip = strip_tags($user_entry);
        $res = trim($strip);
        return $res;
    }
}
