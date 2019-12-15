<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/secretariat")
 */

class SecretariatController extends AbstractController
{
    /**
     * @Route("/accueil", name="secretariat.accueil")
     */
    public function accueil()
    {
        return $this->render('secretariat/index.html.twig', [
            'controller_name' => 'SecretariatController',
            'controller_methode' => 'accueil',
        ]);
    }

    /**
     * @Route("/mesure", name="secretariat.mesure")
     */
    public function mesure()
    {
        return $this->render('secretariat/index.html.twig', [
            'controller_name' => 'SecretariatController',
            'controller_methode' => 'mesure',
        ]);
    }
}
