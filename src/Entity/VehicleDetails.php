<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehicleDetailsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VehicleDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $odometer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motoHours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicle", inversedBy="vehicleDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    public function getOdometer(): ?string
    {
        return $this->odometer;
    }

    public function setOdometer(string $odometer): self
    {
        $this->odometer = $odometer;

        return $this;
    }

    public function getMotoHours(): ?string
    {
        return $this->motoHours;
    }

    public function setMotoHours(string $motoHours): self
    {
        $this->motoHours = $motoHours;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
