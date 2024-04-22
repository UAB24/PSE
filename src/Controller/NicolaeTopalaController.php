<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NicolaeTopalaController extends AbstractController
{
    #[Route('/nicolae_topala')]
    public function index(): Response
    {
        return $this->render('nicolae_topala/index.html.twig');
    }
}
