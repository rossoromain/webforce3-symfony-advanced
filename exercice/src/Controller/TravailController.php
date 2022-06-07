<?php

namespace App\Controller;

use App\Entity\Collegue;
use App\Form\CollegueType;
use App\Repository\CollegueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TravailController extends AbstractController
{
    #[Route('/collegue', name: 'collegue_list')]
    public function list(CollegueRepository $repo): Response
    {
        $collegues = $repo->findAll();

        return $this->render('collegue/list.html.twig', [
            'title' => 'Liste des collegues',
            'collegues' => $collegues
        ]);
    }

    #[Route('/collegue/view/{id}', name: 'collegue_view')]
    public function view(Collegue $collegue = null): Response
    {

        if (!$collegue) {
            return $this->render('404.html.twig');
        }

        return $this->render('collegue/view.html.twig', [
            'title' => 'Collegue n°' . $collegue->getId() ? $collegue->getId() : "Inconnu",
            'collegue' => $collegue
        ]);
    }

    #[Route('/collegue/add', name: 'collegue_add')]
    #[Route('/collegue/edit/{id}', name: 'collegue_edit')]
    public function add(Request $request, EntityManagerInterface $manager, Collegue $collegue = null): Response
    {

        if (!$collegue) {
            $collegue = new Collegue();
        }     

        $form = $this->createForm(CollegueType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) { // si le formulaire est soumis et valide
            
            $manager->persist($collegue); // prépare insertion
            $manager->flush(); // insert
            return $this->redirectToRoute('collegue_view', [
                'id' => $collegue->getId()
            ]);
        }

        return $this->renderForm('collegue/add.html.twig', [
            'title' => 'Ajout de collegue',
            'formCollegue' => $form
        ]);
    }
    
}
