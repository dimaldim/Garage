<?php


namespace App\Controller\Vehicles;

use App\Entity\Vehicle;
use App\Entity\VehicleDetails;
use App\Form\VehicleDetailsType;
use App\Services\VehicleService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OdometerController extends AbstractController
{
    /**
     * @Route("/vehicle/odometer", name="vehicle_odometer")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @param Request $request
     * @param VehicleService $vehicleService
     * @return Response
     */
    public function index(Request $request, VehicleService $vehicleService)
    {
        $details = new VehicleDetails();
        $form = $this->createForm(VehicleDetailsType::class, $details);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($details);
            $em->flush();;

            $this->addFlash('success', 'Успешна промяна!');
        }

        return $this->render(
            'vehicle/odometer.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/vehicle/odometer/getdetails/{id}", name="get_vehicles_detail_json", requirements={"id"="\d+"})
     * @param Vehicle $vehicle
     * @return JsonResponse
     */
    public function getVehicleDetails(Vehicle $vehicle)
    {
        $odometer = 0;
        $motoHours = 0;

        $vehicleDetails = $this->getDoctrine()->getManager()->getRepository(VehicleDetails::class)->findOneBy(
            ['vehicle' => $vehicle],
            ['id' => 'DESC']
        );

        $odometer = $vehicleDetails->getOdometer();
        $motoHours = $vehicleDetails->getMotoHours();

        return new JsonResponse(
            [
                'odometer' => $odometer,
                'moto_hours' => $motoHours,
            ]
        );
    }

}
