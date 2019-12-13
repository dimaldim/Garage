<?php

namespace App\Controller\Vehicles;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddVehicleController extends AbstractController
{
    /**
     * @Route("/vehicle/add", name="add_vehicle")
     * @param Request $request
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request)
    {

        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash('success', 'Автомобилът е добавен успешно!');

            return $this->redirectToRoute('list_vehicles');
        }

        return $this->render(
            'vehicle/addVehicle.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
