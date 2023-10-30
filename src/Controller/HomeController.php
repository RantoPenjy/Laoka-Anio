<?php

namespace App\Controller;

use App\Constant\DateConstant;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request, Security $security): Response
    {
        setlocale(LC_TIME, NULL);
        $dateNow = new \DateTime('now');
        $timestamp = $dateNow->getTimestamp();
        $formattedDate = strftime('%A %d %B %Y', $timestamp);
//        $day = new \DateTime("l");
//        $date = new \DateTime("j");
//        $month = new \DateTime("F");
//        $year = new \DateTime("Y");
        $malagasy_day = DateConstant::MY_MALAGASY_DAY;
//        $malagasy_month = DateConstant::MY_MALAGASY_MONTH;

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'date'=>$formattedDate,
//            'day'=>$day,
//            'date'=>$date,
//            'year'=>$year,
//            'month'=>$month,
//            'malagasy_day'=>$malagasy_day,
//            'malagasy_month'=>$malagasy_month
        ]);
    }
}

