<?php

namespace App\Entity;

use App\Repository\AsteroidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsteroidRepository::class)
 */
class Asteroid
{
    public const IS_HAZARDOUS_TRUE = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $date;

    /**
     * @ORM\Column(type="integer")
     */
    private int $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;


    /**
     * @ORM\Column(type="boolean")
     */
    private bool $is_hazardous;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=10)
     */
    private string $speed;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return $this
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReference(): ?int
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     * @return $this
     */
    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsHazardous(): ?bool
    {
        return $this->is_hazardous;
    }

    /**
     * @param bool $is_hazardous
     * @return $this
     */
    public function setIsHazardous(bool $is_hazardous): self
    {
        $this->is_hazardous = $is_hazardous;

        return $this;
    }

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }
}
