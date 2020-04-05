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

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class APIController.
 *
 * @category Controller
 * @package  App
 *
 * @Route("/api", defaults={"_format" = "json"})
 */
class APIController extends AbstractController
{
    /**
     * Get documentation.
     *
     * @Route("/", name="api_documentation", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getDocumentation()
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
     * Get random blame.
     *
     * @Route("/random-blame", name="api_random_blame", methods={"GET"})
     *
     * @param PersonRepository $personRepository Person Repository.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
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
