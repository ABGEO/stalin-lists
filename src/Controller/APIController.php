<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/api", defaults={"_format" = "json"})
 */
class APIController extends AbstractController
{
    /**
     * @Route("/", name="api_documentation", methods={"GET"})
     */
    public function documentation()
    {
        $routes = [
            'documentation' => [
                'path' => '/api',
                'method' => 'GET',
                'description' => 'API Documentation (this page).',
            ],
            'randomBlame' => [
                'path' => '/api/random-blame',
                'method' => 'GET',
                'description' => 'Get random blame.',
            ],
        ];

        return $this->json(['Message' => 'See all available API Routes.' , 'routes' => $routes]);
    }

    /**
     * @Route("/random-blame", name="api_random_blame", methods={"GET"})
     */
    public function getRandomBlame(PersonRepository $personRepository)
    {
        $randomBlame = $personRepository->getRandomBlame();
        $randomBlame['dosieUrl'] = $this->generateUrl(
            'dosie',
            ['id' => $randomBlame['id']],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        unset($randomBlame['id']);

        return $this->json($randomBlame);
    }
}
