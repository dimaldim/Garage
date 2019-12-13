<?php


namespace App\Controller\Activities;


use App\Entity\Activity;
use App\Form\ActivityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActivitiesController
 * @package App\Controller\Activities
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ActivitiesController extends AbstractController
{
    /**
     * @Route("/activities/add", name="add_activity")
     * @param Request $request
     * @return Response
     */
    public function addActivity(Request $request)
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            $this->addFlash('success', 'Дейността е добавена успешно!');

            return $this->redirectToRoute('list_activities');
        }

        return $this->render(
            'activity/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/activities/list", name="list_activities")
     * @return Response
     */
    public function listActivities()
    {
        $activities = $this->getDoctrine()->getRepository(Activity::class)->findAll();

        return $this->render(
            'activity/list.html.twig',
            [
                'activities' => $activities,
            ]
        );
    }

    /**
     * @Route("/activities/delete/{id}", name="delete_activity", requirements={"id"="\d+"})
     * @param $id
     * @return RedirectResponse
     */
    public function deleteActivity($id)
    {
        $activity = $this->getDoctrine()->getRepository(Activity::class)->find($id);

        if ($activity) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activity);
            $em->flush();

            $this->addFlash('success', 'Дейността е изтрита успешно!');

        }

        return $this->redirectToRoute('list_activities');
    }

}
