<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository): Response
    {
        $contactList = $contactRepository->findBy([], ['lastname' => 'ASC']);

        return $this->render('contact/index.html.twig', ['contactList' => $contactList]);
    }

    #[Route('/contact/{contactId}', name: 'app_contact_contactId', requirements: ['contactId' => '\d+'])]
    public function show(int $contactId, ContactRepository $contactRepository)
    {
        $contact = $contactRepository->find($contactId);
        if (!$contact) {
            throw new NotFoundHttpException('Aucun utilisateur avec cette id : '.$contactId);
        }
        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }
}
