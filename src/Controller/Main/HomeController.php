<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $isLoggedIn = $this->isGranted('IS_AUTHENTICATED_FULLY');

        if (!$isLoggedIn) {
            return $this->redirectToRoute('app_login');
        }

        return $this->redirectToRoute('garage_dashboard');
    }
}
