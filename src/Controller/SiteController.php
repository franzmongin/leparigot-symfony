<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="site")
     */
    public function home()
    {
        return $this->render('site/home.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    
}
