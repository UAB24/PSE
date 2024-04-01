<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalPageController extends AbstractController
{
    #[Route('/octavian', name: 'octavian')]
    public function index(): Response
    {
        return $this->render('octavian/octavian.html.twig', [
            'controller_name' => 'PersonalPageController',
        ]);
    }
}
