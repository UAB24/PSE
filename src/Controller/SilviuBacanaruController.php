<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SilviuBacanaruController extends AbstractController
{
    #[Route('/silviu_bac', name: 'silviu_bac')]
    public function index(): Response
    {
        return $this->render('silviu_bac/pagina_dinamica.html.twig', [
            'controller_name' => 'SilviuBacanaruController',
        ]);
    }
}