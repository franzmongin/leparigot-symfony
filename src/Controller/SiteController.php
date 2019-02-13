<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="site")
     */
    public function home()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class);
        $restos = $articles->findBy(
            ['category' => 'resto'],
            ['id' => 'ASC']
        );
        $bistros = $articles->findBy(
            ['category' => 'bistro'],
            ['id' => 'ASC']
        );
        $expos = $articles->findBy(
            ['category' => 'expo'],
            ['id' => 'ASC']
        );

            

        return $this->render('site/home.html.twig', [
            'controller_name' => 'SiteController',
            'restos' => $restos,
            'bistros' => $bistros,
            'expos' => $expos
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", requirements={"id":"\d+"})
     * 
     */
    public function show(Article $article)
    {
        return $this->render('site/show.html.twig', [
            'article' => $article
        ]);
    }

    
}
