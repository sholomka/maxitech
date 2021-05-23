<?php

declare(strict_types = 1);

namespace App\Controller;

use App\DTO\AsteroidDTO;
use App\Repository\AsteroidRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AsteroidController
 * @package App\Controller
 */
class AsteroidController extends AbstractController
{
    private AsteroidRepository $asteroidRepository;

    /**
     * AsteroidController constructor.
     */
    public function __construct(
        AsteroidRepository $asteroidRepository
    ) {
        $this->asteroidRepository = $asteroidRepository;
    }

    /**
     * @Route("/neo/hazardous", name="neo_hazardous_get", methods={"GET"})
     */
    public function getHazardousAsteroid(): Response
    {
        $hazardousAsteroids = $this->asteroidRepository->getHazardousAsteroids();
        $asteroidDTOArr = [];

        if ($hazardousAsteroids) {
            foreach ($hazardousAsteroids as $hazardousAsteroid) {
                $asteroidDTOArr[] = new AsteroidDTO($hazardousAsteroid);
            }
        }

        return $this->json($asteroidDTOArr);
    }

    /**
     * @Route("/neo/fastest/{hazardous}", name="neo_fastest_hazardous_get", methods={"GET"})
     * @throws NonUniqueResultException
     */
    public function getFastestAsteroid($hazardous): Response
    {
        $fastestAsteroid = $this->asteroidRepository->getFastestAsteroid(
            filter_var($hazardous, FILTER_VALIDATE_BOOLEAN)
        );
        $asteroidDTO = $fastestAsteroid ? new AsteroidDTO($fastestAsteroid) : [];

        return $this->json($asteroidDTO);
    }

    /**
     * @Route("/neo/best-month/{hazardous}", name="neo_best_month_get", methods={"GET"})
     */
    public function getBestMonthAsteroid($hazardous): Response
    {
        $bestMonth = $this->asteroidRepository->getBestMonth(filter_var($hazardous, FILTER_VALIDATE_BOOLEAN));

        return $this->json(['month' => $bestMonth ? current($bestMonth)['date']->format('M') : '']);
    }
}
