<?php

namespace App\Controller\Vehicles;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteVehicleController extends AbstractController
{
    /**
     * @Route("/vehicle/delete/{id}", name="delete_vehicle", requirements={"id"="\d+"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request, Vehicle $vehicle)
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicle);
            $em->flush();

            $this->addFlash('success', 'Автомобилът е изтрит успешно!');

            return $this->redirectToRoute('list_vehicles');
        }

        return $this->render(
            'vehicle/deleteVehicle.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
