<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ActivityType", inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VehicleActivity", mappedBy="activity")
     */
    private $vehicleActivities;

    public function __construct()
    {
        $this->vehicleActivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?ActivityType
    {
        return $this->type;
    }

    public function setType(?ActivityType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|VehicleActivity[]
     */
    public function getVehicleActivities(): Collection
    {
        return $this->vehicleActivities;
    }

    public function addVehicleActivity(VehicleActivity $vehicleActivity): self
    {
        if (!$this->vehicleActivities->contains($vehicleActivity)) {
            $this->vehicleActivities[] = $vehicleActivity;
            $vehicleActivity->setActivity($this);
        }

        return $this;
    }

    public function removeVehicleActivity(VehicleActivity $vehicleActivity): self
    {
        if ($this->vehicleActivities->contains($vehicleActivity)) {
            $this->vehicleActivities->removeElement($vehicleActivity);
            // set the owning side to null (unless already changed)
            if ($vehicleActivity->getActivity() === $this) {
                $vehicleActivity->setActivity(null);
            }
        }

        return $this;
    }
}
