<?php

 namespace App\Controller;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Attribute\Route;

 class CornelVaideanuPageController extends AbstractController
 {
     #[Route('/cornel-vaideanu', name: 'cornel_vaideanu')]
     public function index(): Response
     {
         return $this->render('cornel-vaideanu/cornel-vaideanu.html.twig', [
             'controller_name' => 'CornelVaideanuPageController',
         ]);
     }
 }