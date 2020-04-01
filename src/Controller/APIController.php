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
     * @Route("/", name="api_documentation")
     */
    public function documentation()
    {
        return $this->json(['success' => true, 'message' => 'API Documentation will be here']);
    }

    /**
     * @Route("/random-blame", name="api_random_blame", methods={"GET"})
     */
    public function randomBlame(PersonRepository $personRepository)
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
