<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EsenovPageController extends AbstractController
{
    #[Route('/esenov', name: 'esenov_page')]
    public function index(
        Request $request, 
        EntityManagerInterface $entityManager,
        ContactMessageRepository $contactRepository
    ): Response {
        
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactMessage);
            $entityManager->flush();

            $this->addFlash('success', 'Hocam mesajın başarıyla kaydedildi!');
            return $this->redirectToRoute('esenov_page');
        }

        // Tüm mesajları çekiyoruz
        $oldMessages = $contactRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('esenov_page/index.html.twig', [
            'esenov_form' => $form->createView(),
            'messages' => $oldMessages
        ]);
    }

    // İŞTE EKSİK OLAN KISIM BURASIYDI:
    #[Route('/esenov/delete/{id}', name: 'esenov_delete')]
    public function delete(ContactMessage $message, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($message);
        $entityManager->flush();

        $this->addFlash('danger', 'Mesaj başarıyla silindi hocam!');
        
        return $this->redirectToRoute('esenov_page');
    }
}