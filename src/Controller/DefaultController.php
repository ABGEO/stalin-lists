<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
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

        return $this->render(
            'default/index.html.twig',
            [
                'randomBlame' => $randomBlame,
            ]
        );
    }

    /**
     * @Route("/list/{page}", name="list", defaults={"page": "1"}, requirements={"page": "\d+"})
     */
    public function list(int $page, PersonRepository $personRepository, PaginatorInterface $paginator)
    {
        /** @var Person[] $people */
        $people = $paginator->paginate(
            $personRepository->getQueryBuilder(),
            $page,
            100
        );

        return $this->render(
            'default/list.html.twig',
            [
                'people' => $people,
            ]
        );
    }

}
