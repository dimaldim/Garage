<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehicleRepository")
 * @UniqueEntity(fields={"plateNumber"}, message="Автомобил с такъв регистрационен номер вече съществува!")
 * @ORM\HasLifecycleCallbacks()
 */
class Vehicle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете регистрационен номер")"
     */
    private $plateNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете марка")
     */
    private $carMake;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете модел")
     */
    private $carModel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете година на производство")
     */
    private $carYear;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете номер на шаси")
     */
    private $vinNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете номер на двигател")
     */
    private $engineNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете собственик")
     */
    private $carOwner;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Въведете отговорник")
     */
    private $personInCharge;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAdded;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VehicleDetails", mappedBy="vehicle", fetch="EAGER")
     */
    private $vehicleDetails;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VehicleActivity", mappedBy="vehicle")
     */
    private $vehicleActivities;

    public function __construct()
    {
        $this->vehicleDetails = new ArrayCollection();
        $this->vehicleActivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlateNumber(): ?string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): self
    {
        $this->plateNumber = $plateNumber;

        return $this;
    }

    public function getCarMake(): ?string
    {
        return $this->carMake;
    }

    public function setCarMake(string $carMake): self
    {
        $this->carMake = $carMake;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->carModel;
    }

    public function setCarModel(string $carModel): self
    {
        $this->carModel = $carModel;

        return $this;
    }

    public function getCarYear(): ?string
    {
        return $this->carYear;
    }

    public function setCarYear(string $carYear): self
    {
        $this->carYear = $carYear;

        return $this;
    }

    public function getVinNumber(): ?string
    {
        return $this->vinNumber;
    }

    public function setVinNumber(string $vinNumber): self
    {
        $this->vinNumber = $vinNumber;

        return $this;
    }

    public function getEngineNumber(): ?string
    {
        return $this->engineNumber;
    }

    public function setEngineNumber(string $engineNumber): self
    {
        $this->engineNumber = $engineNumber;

        return $this;
    }

    public function getCarOwner(): ?string
    {
        return $this->carOwner;
    }

    public function setCarOwner(string $carOwner): self
    {
        $this->carOwner = $carOwner;

        return $this;
    }

    public function getPersonInCharge(): ?string
    {
        return $this->personInCharge;
    }

    public function setPersonInCharge(string $personInCharge): self
    {
        $this->personInCharge = $personInCharge;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateAdded(): self
    {
        $this->dateAdded = new \DateTime();

        return $this;
    }

    /**
     * @return Collection|VehicleDetails[]
     */
    public function getVehicleDetails(): Collection
    {
        return $this->vehicleDetails;
    }

    public function addVehicleDetail(VehicleDetails $vehicleDetail): self
    {
        if (!$this->vehicleDetails->contains($vehicleDetail)) {
            $this->vehicleDetails[] = $vehicleDetail;
            $vehicleDetail->setVehicle($this);
        }

        return $this;
    }

    public function removeVehicleDetail(VehicleDetails $vehicleDetail): self
    {
        if ($this->vehicleDetails->contains($vehicleDetail)) {
            $this->vehicleDetails->removeElement($vehicleDetail);
            // set the owning side to null (unless already changed)
            if ($vehicleDetail->getVehicle() === $this) {
                $vehicleDetail->setVehicle(null);
            }
        }

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
            $vehicleActivity->setVehicle($this);
        }

        return $this;
    }

    public function removeVehicleActivity(VehicleActivity $vehicleActivity): self
    {
        if ($this->vehicleActivities->contains($vehicleActivity)) {
            $this->vehicleActivities->removeElement($vehicleActivity);
            // set the owning side to null (unless already changed)
            if ($vehicleActivity->getVehicle() === $this) {
                $vehicleActivity->setVehicle(null);
            }
        }

        return $this;
    }

}
