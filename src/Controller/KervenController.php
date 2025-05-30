<?php

namespace App\Controller;

use App\Entity\KervenPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class KervenController extends AbstractController
{
    private const ADMIN_USERNAME = 'admin';
    private const ADMIN_PASSWORD = 'admin123'; // In production, use proper authentication

    #[Route('/kerven', name: 'app_kerven')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $page = $entityManager->getRepository(KervenPage::class)->findOneBy(['slug' => 'kerven']);

        if (!$page) {
            // Create default content if no page exists
            $page = new KervenPage();
            $page->setTitle("Welcome to My Page");
            $page->setDescription("Hello! I'm Kerven, and I'm passionate about web development and technology. I enjoy creating innovative solutions and learning new programming languages and frameworks. My journey in software development has been exciting and full of continuous learning opportunities.\n\nWhen I'm not coding, I love exploring new technologies, contributing to open-source projects, and sharing knowledge with the developer community. I believe in the power of technology to make a positive impact on people's lives.");
            $page->setPhoto("kerven.jpg");
            $page->setSlug("kerven");
            $page->setInterests("Web Development\nArtificial Intelligence\nCloud Computing\nUI/UX Design\nOpen Source Projects");

            $entityManager->persist($page);
            $entityManager->flush();
        }

        return $this->render('kerven/index.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/kerven/login', name: 'app_kerven_login')]
    public function login(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            if ($username === self::ADMIN_USERNAME && $password === self::ADMIN_PASSWORD) {
                $session = $request->getSession();
                $session->set('kerven_logged_in', true);
                return $this->redirectToRoute('app_kerven_edit');
            }

            $this->addFlash('error', 'Invalid credentials');
        }

        return $this->render('kerven/login.html.twig');
    }

    #[Route('/kerven/edit', name: 'app_kerven_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $session = $request->getSession();
        if (!$session->get('kerven_logged_in')) {
            return $this->redirectToRoute('app_kerven_login');
        }

        $page = $entityManager->getRepository(KervenPage::class)->findOneBy(['slug' => 'kerven']);

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $interests = $request->request->get('interests');

            $file = $request->files->get('photo');
            if ($file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = $filename . "." . $file->guessExtension();
                $file->move($this->getParameter('kernel.project_dir') . "/public/images/", $filename);
                $page->setPhoto($filename);
            }

            $page->setTitle($title);
            $page->setDescription($description);
            $page->setInterests($interests);

            $errors = $validator->validate($page);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }

            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('app_kerven');
        }

        return $this->render('kerven/edit.html.twig', [
            'page' => $page,
        ]);
    }
} 