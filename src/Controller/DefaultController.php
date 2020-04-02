<?php

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

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/feedback", name="feedback")
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
