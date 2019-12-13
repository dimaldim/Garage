<?php


namespace App\Controller\VehicleActivities;


use App\Entity\Vehicle;
use App\Entity\VehicleActivity;
use App\Form\VehicleActivityType;
use App\Services\VehicleService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VehicleActivities
 * @package App\Controller\VehicleActivities
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class VehicleActivities extends AbstractController
{
    /**
     * @Route("/vehicle/add_activity", name="add_vehicle_activity")
     * @param Request $request
     * @param VehicleService $vehicleService
     * @return Response
     */
    public function addVehicleActivity(Request $request, VehicleService $vehicleService)
    {
        $vehicle = null;
        if ($vehicleService->getVehicle()) {
            $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find(
                $vehicleService->getVehicle()->getId()
            );
        }

        $activity = new VehicleActivity();
        $activity->setVehicle($vehicle);

        $form = $this->createForm(VehicleActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            //
        }

        return $this->render(
            'vehicle/activity/add.html.twig',
            [
                'form' => $form->createView(),
                'vehicle' => $vehicle,
            ]
        );
    }

    /**
     * @Route("/vehicle/edit_activity/{id}", name="edit_vehicle_activity", requirements={"id"="\d+"})
     * @param Request $request
     * @param VehicleActivity $vehicleActivity
     * @return Response
     */
    public function editVehicleActivity(Request $request, VehicleActivity $vehicleActivity)
    {

        $form = $this->createForm(VehicleActivityType::class, $vehicleActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            $this->addFlash('success', 'Дейността е редактирана успешно!');
        }

        return $this->render(
            'vehicle/activity/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/vehicle/delete_activity/{id}", name="delete_vehicle_activity", requirements={"id"="\d+"})
     * @param Request $request
     * @param VehicleActivity $vehicleActivity
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function deleteVehicleActivity(Request $request, VehicleActivity $vehicleActivity)
    {
        $form = $this->createForm(VehicleActivityType::class, $vehicleActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicleActivity);
            $em->flush();

            $this->addFlash('success', 'Дейността е изтрита успешно!');

            return $this->redirectToRoute('list_vehicle_activities');
        }

        return $this->render(
            'vehicle/activity/delete.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/vehicle/list_activities", name="list_vehicle_activities")
     * @return Response
     */
    public function listVehicleActivities()
    {
        $activities = $this->getDoctrine()->getRepository(VehicleActivity::class)->findAll();

        return $this->render(
            'vehicle/activity/list.html.twig',
            [
                'activities' => $activities,
            ]
        );
    }
}
