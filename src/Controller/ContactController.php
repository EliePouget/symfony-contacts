<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact') ]
    public function index(Request $request, ContactRepository $contactRepository): Response
    {
        $search = $request->query->get('search');
        $contactList = $contactRepository->search("$search");

        return $this->render('contact/index.html.twig', ['contactList' => $contactList, 'search' => $search]);
    }

    #[Route('/contact/{id}', name: 'app_contact_id', requirements: ['contactId' => '\d+'])]
    #[ParamConverter('id', class: 'App\Entity\Contact')]
    public function show(Contact $contact)
    {
        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }
}
