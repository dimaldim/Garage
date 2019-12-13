<?php

namespace App\Controller\Vehicles;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditVehicleController extends AbstractController
{
    /**
     * @Route("/vehicle/edit/{id}", name="edit_vehicle", requirements={"id"="\d+"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request, Vehicle $vehicle)
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash('success', 'Автомобилът е редактиран успешно!');

            return $this->render(
                'vehicle/editVehicle.html.twig',
                [
                    'form' => $form->createView(),
                ]
            );
        }

        return $this->render(
            'vehicle/editVehicle.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
