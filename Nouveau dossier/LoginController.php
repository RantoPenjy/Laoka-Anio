<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request, EntityManagerInterface $manager, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $passwordHasher): Response
    {
        $users = new User();
        // Création du formulaire de connexion
        $form = $this->createForm(LoginType::class, $users);

        // Récupération des erreurs d'authentification précédentes
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupération du dernier nom d'utilisateur (email) entré par l'utilisateur
        $lastEmail = $authenticationUtils->getLastUsername();

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $data = $form->getData();

                // Recherche de l'utilisateur correspondant à l'adresse email entrée
                $user = $manager
                    ->getRepository(User::class)
                    ->findOneBy(['email' => $data->getEmail()]);

                if (!$user || !$passwordHasher->isPasswordValid($user, $data->getPassword()))
                {
                    throw new BadCredentialsException('Invalid password.');

//                    return $this->redirectToRoute('login');
                }

                // Ouverture de la session utilisateur
                $session = $request->getSession();
                $session->start();
                $session->set('user_id', $user->getId());
                $session->set('name', $user->getName());
                $session->set('firstname', $user->getId());

                $this->addFlash('success', 'Vous êtes maintenant connecté.');

                // Redirection vers la page d'accueil
                return $this->redirectToRoute('homepage');
            }
        }
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
            'last_email' => $lastEmail,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request): Response
    {
        // Fermeture de la session utilisateur
        $session = $request->getSession();
        $session->clear();

        $this->addFlash('success', 'Vous êtes maintenant déconnecté.');

        // Redirection vers la page de connexion
        return $this->redirectToRoute('homepage');
    }
}
