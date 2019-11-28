<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BraveFinderController extends AbstractController
{
    /**
     * @Route("/", name="main.index")
     */
    public function index()
    {
        return $this->render('brave_finder/index.html.twig', [
            'controller_name' => 'BraveFinderController',
        ]);
    }
}
