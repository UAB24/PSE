<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SorinaPageController extends AbstractController
{
    #[Route('/sorina', name: 'sorina')]
    public function index(): Response
    {
    return $this->render('sorina/index.html.twig', [
    'controller_name' => 'SorinaPageController',
    ]);
    }
}
