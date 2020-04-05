<?php

/*
 * This file is part of the ABGEO/StalinList project.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Person;
use App\Form\FeedbackFormType;
use App\Form\PersonSearchFormType;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController.
 *
 * @category Controller
 * @package  App
 */
class DefaultController extends AbstractController
{
    /**
     * Render homepage.
     *
     * @Route("/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Render persons list with pagination and filters.
     *
     * @Route("/list/{page}", name="list", defaults={"page": "1"}, requirements={"page": "\d+"})
     *
     * @param int $page                          Current page number.
     * @param PersonRepository $personRepository Person Repository.
     * @param PaginatorInterface $paginator      Paginator.
     * @param Request $request                   Current request object.
     *
     * @return \Symfony\Component\HttpFoundation\Response
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
     * Render single Dosie page.
     *
     * @Route("/dosie/{id}", name="dosie")
     * @ParamConverter("person", class="App\Entity\Person")
     *
     * @param Person $person Single person.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dosie(Person $person)
    {
        return $this->render('default/dosie.html.twig', ['person' => $person]);
    }

    /**
     * Render About page.
     *
     * @Route("/about", name="about")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * Render Feedback page and handle form.
     *
     * @Route("/feedback", name="feedback")
     *
     * @param Request $request      Current request object.
     * @param \Swift_Mailer $mailer SwiftMailer instance.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function feedback(Request $request, \Swift_Mailer $mailer)
    {
        $formData = null;
        $message = null;
        $feedbackForm = $this->createForm(FeedbackFormType::class);
        $feedbackForm->handleRequest($request);

        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()) {
            $formData = $feedbackForm->getData();

            $message = (new \Swift_Message($formData['subject']))
                ->setFrom(getenv('SITE_EMAIL'))
                ->setTo(getenv('CONTACT_EMAIL'))
                ->setBody(
                    $this->renderView(
                        'email/feedback.html.twig',
                        [
                            'name' => $formData['name'],
                            'email' => $formData['email'],
                            'message' => $formData['message'],
                        ]
                    ),
                    'text/html'
                );

            if ($mailer->send($message)) {
                $this->addFlash('success', 'შეტყობინება წარმატებით გაიგზავნა!');
            } else {
                $this->addFlash('danger', 'შეტყობინება გაგზავნისასა დაფიქსირდა შეცდომა. სცადეთ მოგვიანებით!');
            }

            return $this->redirectToRoute('feedback');
        }

        return $this->render('default/feedback.html.twig', ['feedbackForm' => $feedbackForm->createView(),]);
    }
}
