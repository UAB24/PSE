<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AndreeaController extends AbstractController
{
    #[Route('/andreea', name: 'app_andreea')]
    public function index(): Response
    {
        return $this->render('andreea/index.html.twig', [
            'controller_name' => 'AndreeaController',
        ]);
    }
}
