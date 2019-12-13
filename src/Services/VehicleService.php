<?php

namespace App\Services;

use App\Entity\Vehicle;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class VehicleService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $this->session->set('choosen-vehicle', $vehicle);
    }

    public function getVehicle()
    {
        return $this->session->get('choosen-vehicle');
    }

    public function unsetVehicle()
    {
        $this->session->remove('choosen-vehicle');
    }

}
