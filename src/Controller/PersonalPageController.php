<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalPageController extends AbstractController
{
    #[Route('/enri', name: 'app_personal_page')]
    public function index(): Response
    {
        return $this->render('rapaj/index.html.twig', [
            'controller_name' => 'PersonalPageController',
        ]);
    }
}