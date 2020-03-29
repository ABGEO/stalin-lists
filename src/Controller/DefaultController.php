<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(PersonRepository $personRepository)
    {
        $randomBlame = $personRepository->getRandomBlame();

        return $this->render('default/index.html.twig', [
            'randomBlame' => $randomBlame,
        ]);
    }

}
