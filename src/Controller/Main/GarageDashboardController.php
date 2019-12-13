<?php

namespace App\Controller\Main;

use App\Entity\Vehicle;
use App\Services\VehicleService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GarageDashboardController
 * @package App\Controller
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class GarageDashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="garage_dashboard")
     * @param VehicleService $vehicleService
     * @return Response
     */
    public function index(VehicleService $vehicleService)
    {
        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findAll();

        return $this->render(
            'dashboard/index.html.twig',
            [
                'vehicle' => $vehicles,
                'choosen_vehicle' => $vehicleService->getVehicle(),
            ]
        );
    }

    public function vehicleDashboard(VehicleService $vehicleService)
    {
        $vehicle = $vehicleService->getVehicle();

        return $this->render(
            'dashboard/vehicleDashboard.html.twig',
            [
                'vehicle' => $vehicle,
            ]
        );
    }

    /**
     * @Route("/dashboard/setvehicle/{id}", name="set_vehicle", requirements={"id"="\d+"})
     * @param VehicleService $vehicleService
     * @param Vehicle $vehicle
     * @return Response
     */
    public function setVehicle(VehicleService $vehicleService, Vehicle $vehicle)
    {
        if ($vehicle) {
            $vehicleService->setVehicle($vehicle);
        }

        return $this->redirectToRoute('garage_dashboard');
    }

    /**
     * @Route("/dashboard/unsetvehicle", name="unset_vehicle")
     * @param VehicleService $vehicleService
     * @return Response
     */
    public function unsetVehicle(VehicleService $vehicleService)
    {
        $vehicleService->unsetVehicle();

        return $this->redirectToRoute('garage_dashboard');
    }
}
