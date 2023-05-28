<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }
    
    #[Route(path: '/inscription', name: 'inscription')] 
    public function inscription(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe avant de l'enregistrer
            $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // Rediriger l'utilisateur vers une page de succès ou une autre page appropriée
            return $this->redirectToRoute('inscription_success');
        }

        return $this->render('inscription/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/inscription/success', name: 'inscription_success')]
    public function inscriptionSuccess(): Response
    {
        return $this->render('inscription/inscription_success.html.twig');
    }
}
