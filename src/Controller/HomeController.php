<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'contacts' => $this->contactRepository->findAll(),
            'total' => $this->totalCalcul(),
        ]);
    }

    private $contactRepository;

    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    public function totalCalcul(){
        $gestionEntity = $this->getDoctrine()->getManager();

        $TableContact = $gestionEntity->getRepository(Contact::class);

        return $TableContact->createQueryBuilder('contact')
            ->select('COUNT(contact)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}