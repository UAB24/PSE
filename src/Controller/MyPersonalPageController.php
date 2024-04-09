<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyPersonalPageController extends AbstractController
{
    #[Route('/sergiu', name: 'app_my_personal_page')]
    public function index(): Response
    {
        return $this->render('my_personal_page/sergiu.html.twig', [
            'controller_name' => 'MyPersonalPageController',
        ]);
    }
}
