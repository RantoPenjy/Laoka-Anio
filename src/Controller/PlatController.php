<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatController extends AbstractController
{
    #[Route('/plat/list', name: 'plat_list')]
    public function index(EntityManagerInterface $manager): Response
    {
        $plat = $manager
            ->getRepository(Plat::class)
            ->findAll();

        return $this->render('plat/index.html.twig', [
            'controller_name' => 'PlatController',
            'plat' => $plat
        ]);
    }

    #[Route('/plat/random', name: 'random_plat')]
    public function randomPlat(EntityManagerInterface $manager, Request $request): Response
    {
        $day = date('l');

        if ($day != 'Sunday') {
            $day = false;
        }
        else
        {
            $day = true;
        }

        $plat = $manager
            ->getRepository(Plat::class)
            ->findBy(array('day'=>$day));

        # shuffle all data
        # shuffle($plat);

        # get a random number for the index
        $random_index = rand(0, count($plat)-1);
        $plat_randomized = $plat[$random_index];

        return $this->json($plat_randomized);
    }

    #[Route('/plat/add', name: 'add_plat')]
    public function addPlat(Request $request, EntityManagerInterface $manager): Response
    {
        $plat = new Plat();

        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($plat);
            $manager->flush();

            return $this->redirectToRoute('plat_list');
        }

        return $this->render('plat/add_plat.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/plat/delete/{id}', name: 'delete_plat')]
    public function deletePlat(EntityManagerInterface $manager, Plat $plat): Response
    {
        $manager->remove($plat);
        $manager->flush();

        return $this->redirectToRoute('plat_list');
    }

    #[Route('/plat/api/list', name: 'api_plat_list')]
    public function list(EntityManagerInterface $manager): Response
    {
        $plat = $manager
            ->getRepository(Plat::class)
            ->findAll();

	    $response = new JsonResponse($plat);
	    $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
