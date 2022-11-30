<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact') ]
    public function index(Request $request, ContactRepository $contactRepository): Response
    {
        $page = $request->query->get('page', 1);
        $form = $this->createForm(Contact::class, $contactRepository);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
        }
        $search = $request->query->get('search');
        $contactList = $contactRepository->search("$search");

        return $this->render('contact/index.html.twig', ['contactList' => $contactList, 'search' => $search]);
    }

    #[Route('/contact/{id}', name: 'app_contact_id', requirements: ['id' => '\d+'])]
    #[Entity('contact', expr: 'repository.findWithCategory(id)')]
    public function show(Contact $contact)
    {
        dump($contact);

        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact/create', name: 'app_contact_create')]
    public function create()
    {
        return $this->render('contact/create.html.twig');
    }

    #[Route('/contact/{id}/update', name: 'app_contact_update', requirements: ['id' => '\d+'])]
    public function update(Contact $contact)
    {

        $form = $this->createForm(ContactType::class, $contact);

        return $this->renderForm('contact/update.html.twig',
            ['form' => $form,
            'contact' => $contact, ]);
    }

    #[Route('/contact/{id}/delete', name: 'app_contact_delete', requirements: ['id' => '\d+'])]
    public function delete(Contact $contact)
    {
        return $this->render('contact/delete.html.twig', ['contact' => $contact]);
    }
}
