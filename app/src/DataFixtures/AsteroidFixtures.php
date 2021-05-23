<?php

namespace App\DataFixtures;

use App\Entity\Asteroid;
use Carbon\Carbon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class AsteroidFixtures
 * @package App\DataFixtures
 */
class AsteroidFixtures extends Fixture
{
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    /**
     * AsteroidFixtures constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(
        ParameterBagInterface $parameterBag
    ) {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @param ObjectManager $manager
     * @throws GuzzleException
     */
    public function load(ObjectManager $manager): void
    {
        $startDate = Carbon::now()->addDays(-2)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        $apiKey = $this->parameterBag->get('api.nasa.gov.api_key');
        $host = $this->parameterBag->get('api.nasa.gov.host');
        $uri = sprintf($this->parameterBag->get('api.nasa.gov.uri'), $host, $startDate, $endDate, $apiKey);

        $client = new Client();
        $response = $client->send(new Request('GET', $uri));
        $content = $response->getBody()->getContents();
        $jsonContent = json_decode($content, true);
        $nearEarthObjects = $jsonContent['near_earth_objects'] ?? [];

        if ($nearEarthObjects) {
            foreach ($nearEarthObjects as $date => $asteroids) {
                foreach ($asteroids as $asteroid) {
                    $asteroidEntity = new Asteroid();
                    $asteroidEntity->setDate(\DateTime::createFromFormat('Y-m-d', $date));
                    $asteroidEntity->setName($asteroid['name'] ?? '');
                    $asteroidEntity->setReference($asteroid['neo_reference_id'] ?? 0);
                    $asteroidEntity->setIsHazardous($asteroid['is_potentially_hazardous_asteroid'] ?? '');
                    $closeApproachData = $asteroid['close_approach_data'] ?? [];
                    $asteroidEntity->setSpeed(current($closeApproachData)['relative_velocity']['kilometers_per_hour'] ?? '');
                    $manager->persist($asteroidEntity);
                }
            }
        }

        $manager->flush();
    }
}
