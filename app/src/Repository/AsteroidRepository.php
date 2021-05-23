<?php

namespace App\Repository;

use App\Entity\Asteroid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asteroid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asteroid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asteroid[]    findAll()
 * @method Asteroid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsteroidRepository extends ServiceEntityRepository
{
    /**
     * AsteroidRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asteroid::class);
    }

    /**
     * @return Asteroid[]
     */
    public function getHazardousAsteroids(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.is_hazardous = :val')
            ->setParameter('val', Asteroid::IS_HAZARDOUS_TRUE)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param bool $isHazardous
     * @return Asteroid|null
     * @throws NonUniqueResultException
     */
    public function getFastestAsteroid(bool $isHazardous): ?Asteroid
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.is_hazardous = :isHazardous')
            ->setParameter('isHazardous', $isHazardous)
            ->orderBy('a.speed', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param bool $isHazardous
     * @return array|null
     */
    public function getBestMonth(bool $isHazardous): array
    {
        return $this->createQueryBuilder('a')
            ->select('a.date')
            ->andWhere('a.is_hazardous = :isHazardous')
            ->setParameter('isHazardous', $isHazardous)
            ->groupBy('a.date')
            ->orderBy('COUNT(a.id)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }
}
