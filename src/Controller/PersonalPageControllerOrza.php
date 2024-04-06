<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalPageControllerOrza extends AbstractController
{
    #[Route('/orza', name: 'orza')]
    public function index(): Response
    {
        return $this->render('orza/index.html.twig', [
            'controller_name' => 'PersonalPageControllerOrza',
        ]);
    }
}