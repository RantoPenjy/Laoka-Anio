<?php

namespace App\Controller;

use App\Constant\DateConstant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        $day = date("l");
        $date = date("j");
        $month = date("F");
        $year = date("Y");
        $malagasy_day = DateConstant::MY_MALAGASY_DAY;
        $malagasy_month = DateConstant::MY_MALAGASY_MONTH;

        if (!$session->has('user_id'))
        {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'day'=>$day,
                'date'=>$date,
                'year'=>$year,
                'month'=>$month,
                'malagasy_day'=>$malagasy_day,
                'malagasy_month'=>$malagasy_month,
                'connected'=>false
            ]);
        }
        else
        {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'day'=>$day,
                'date'=>$date,
                'year'=>$year,
                'month'=>$month,
                'malagasy_day'=>$malagasy_day,
                'malagasy_month'=>$malagasy_month,
                'connected'=>true,
                'user_id'=>$session->get('user_id'),
                'user_name'=>$session->get('user_name'),
                'user_firstname'=>$session->get('user_firstname'),
            ]);
        }
    }
}

