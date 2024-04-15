<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalPageControllerRapaj extends AbstractController
{
    #[Route('/rapaj', name: 'rapaj')]
    public function index(): Response
    {
        return $this->render('rapaj/index.html.twig', [
            'controller_name' => 'PersonalPageControllerRapaj',
        ]);
    }
}