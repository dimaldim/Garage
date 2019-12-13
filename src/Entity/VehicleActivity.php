<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehicleActivityRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VehicleActivity
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="vehicleActivities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $work;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serviz;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $supplier;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicle", inversedBy="vehicleActivities")
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

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getWork(): ?string
    {
        return $this->work;
    }

    public function setWork(string $work): self
    {
        $this->work = $work;

        return $this;
    }

    public function getParts(): ?string
    {
        return $this->parts;
    }

    public function setParts(string $parts): self
    {
        $this->parts = $parts;

        return $this;
    }

    public function getServiz(): ?string
    {
        return $this->serviz;
    }

    public function setServiz(string $serviz): self
    {
        $this->serviz = $serviz;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
