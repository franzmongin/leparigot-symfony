<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use App\Entity\Article;

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

    /**
     * @Route("/{id}", name="article_show")
     * 
     */
    public function show(Article $article)
    {
        return $this->render('site/show.html.twig', [
            'article' => $article
        ]);
    }

    
}
