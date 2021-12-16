<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @var ContactRepository
     */

    /**
     * @Route("/contactez-nous", name="contact")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        dump($form->getViewData());

        if ($form->isSubmitted() && $form->isValid()){
            $entityTest = $this->getDoctrine()->getManager();
            $entityTest->persist($form->getData());
            $entityTest->flush();
            dump("OK");
        }

        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/contacter/{city}", name="contactCity")
     */
    public function contactCity(Request $request, string $city): Response
    {
        $request->headers->get('Referer');
        $name = $request->query->get('name');

        dump($name);

        return $this->render('contact/index.html.twig', [
            'name' => $name,
            'city' => $city
        ]);
    }
}