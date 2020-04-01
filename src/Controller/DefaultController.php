<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonSearchFormType;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
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
            100,
            [
                'defaultSortFieldName' => ['p.surname', 'p.name', 'p.patronymic'],
                'defaultSortDirection' => 'asc',
            ]
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

    /**
     * @Route("/dosie/{id}", name="dosie")
     * @ParamConverter("person", class="App\Entity\Person")
     */
    public function dosie(Person $person)
    {
        return $this->render('default/dosie.html.twig', ['person' => $person]);
    }
}
