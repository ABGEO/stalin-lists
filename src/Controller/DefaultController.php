<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonSearchFormType;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function list(int $page, PersonRepository $personRepository, PaginatorInterface $paginator, Request $request)
    {
        /** @var Person[] $people */
        $people = $paginator->paginate(
            $personRepository->getQueryBuilderForList($request->get('person_search_form') ?? []),
            $page,
            100
        );

        $searchForm = $this->createForm(PersonSearchFormType::class);

        return $this->render(
            'default/list.html.twig',
            [
                'people' => $people,
                'searchForm' => $searchForm->createView(),
            ]
        );
    }

}
