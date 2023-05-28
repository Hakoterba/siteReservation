<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        // Ajoutez ici la logique métier spécifique à la page d'accueil
        $message = "Bienvenue sur la page d'accueil !";

        // Renvoie la réponse
        return $this->render('home/index.html.twig', [
            'message' => $message,
        ]);
    }
}
