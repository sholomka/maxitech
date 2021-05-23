<?php

namespace App\DTO;

use App\Entity\Asteroid;

/**
 * Class AsteroidDTO
 * @package App\DTO
 */
class AsteroidDTO
{
    /**
     * @var Asteroid
     */
    private Asteroid $asteroid;

    /**
     * AsteroidDTO constructor.
     */
    public function __construct(Asteroid $asteroid)
    {
        $this->asteroid = $asteroid;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->asteroid->getId();
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->asteroid->getDate()->format('Y-m-d');
    }

    /**
     * @return int|null
     */
    public function getReference(): ?int
    {
        return $this->asteroid->getReference();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->asteroid->getName();
    }

    /**
     * @return string|null
     */
    public function getSpeed(): ?string
    {
        return $this->asteroid->getSpeed();
    }

    /**
     * @return bool|null
     */
    public function isHazardous(): ?bool
    {
        return $this->asteroid->getIsHazardous();
    }
}
