<?php

namespace App\Controller\Vehicles;

use App\Entity\Vehicle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListVehiclesController extends AbstractController
{
    /**
     * @Route("/vehicle/list", name="list_vehicles")
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index()
    {
        $vehicles = $this->getDoctrine()->getManager()->getRepository(Vehicle::class)->findAll();

        return $this->render(
            'vehicle/listVehicles.html.twig',
            [
                'vehicles' => $vehicles,
            ]
        );
    }
}
