<?php

namespace App\Controller;

use App\Entity\BatyrPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BatyrPersonalPageController extends AbstractController
{
    #[Route('/batyr', name: 'app_batyr_personal_page')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $page = $entityManager->getRepository(BatyrPage::class)->findOneBy(['slug' => 'batyr']);

        if (!$page) {
            // Create default content if no page exists
            $page = new BatyrPage();
            $page->setTitle("Hi, I'm Batyr Nazzyyev");
            $page->setDescription("Welcome to my personal page! I'm a passionate developer who loves building web applications and learning new technologies. My journey in software development has been filled with exciting challenges and rewarding experiences.\n\nWhen I'm not coding, I enjoy exploring the outdoors, reading about science and technology, and spending time with friends and family. I believe in continuous growth and strive to improve my skills every day.\n\nHere are a few things about me:\n- Enthusiastic about open-source projects\n- Enjoys problem-solving and creative thinking\n- Always eager to learn and share knowledge");
            $page->setPhoto("batyr.jpg");
            $page->setSlug("batyr");
            
            $entityManager->persist($page);
            $entityManager->flush();
        }

        return $this->render('personal_page/batyr.html.twig', [
            'page' => $page
        ]);
    }

    #[Route('/batyr/login', name: 'app_batyr_login')]
    public function login(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            // Hardcoded credentials (in a real app, these would be in a database)
            if ($username === 'admin' && $password === 'admin123') {
                $session = $request->getSession();
                $session->set('batyr_logged_in', true);
                return $this->redirectToRoute('app_batyr_edit');
            }

            $this->addFlash('error', 'Invalid credentials');
        }

        return $this->render('personal_page/batyr_login.html.twig');
    }

    #[Route('/batyr/edit', name: 'app_batyr_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $session = $request->getSession();
        if (!$session->get('batyr_logged_in')) {
            return $this->redirectToRoute('app_batyr_login');
        }

        $page = $entityManager->getRepository(BatyrPage::class)->findOneBy(['slug' => 'batyr']);

        if (!$page) {
            $page = new BatyrPage();
        }

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');

            $file = $request->files->get('photo');
            if ($file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = $filename . "." . $file->guessExtension();
                $file->move($this->getParameter('kernel.project_dir') . "/public/images/", $filename);
                $page->setPhoto($filename);
            }

            $page->setTitle($title);
            $page->setDescription($description);
            $page->setSlug('batyr');

            $errors = $validator->validate($page);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }

            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('app_batyr_edit');
        }

        return $this->render('personal_page/batyr_edit.html.twig', [
            'page' => $page
        ]);
    }

    #[Route('/batyr/logout', name: 'app_batyr_logout')]
    public function logout(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove('batyr_logged_in');
        return $this->redirectToRoute('app_batyr_personal_page');
    }
} 