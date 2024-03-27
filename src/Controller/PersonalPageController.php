<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalPageController extends AbstractController
{
    #[Route('/antonina', name: 'app_personal_page')]
    public function index(): Response
    {
        return $this->render('personal_page/antonina.html.twig', [
            'controller_name' => 'PersonalPageController',
        ]);
    }
}