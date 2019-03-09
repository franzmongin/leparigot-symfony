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
            ['id' => 'DESC'],
            3
        );
        $bistros = $articles->findBy(
            ['category' => 'bistro'],
            ['id' => 'DESC'],
            3
        );
        $expos = $articles->findBy(
            ['category' => 'expo'],
            ['id' => 'DESC'],
            3
        );

            

        return $this->render('site/home.html.twig', [
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

    /**
     * @Route("/resto", name="resto")
     */
    public function resto()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class);
        $restos = $articles->findBy(
            ['category' => 'resto']
        );

        return $this->render('site/resto.html.twig',[
            'restos' => $restos
        ]);
    }

    /**
     * @Route("/bistro", name="bistro")
     */
    public function bistro()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class);
        $bistros = $articles->findBy(
            ['category' => 'bistro']
        );

        return $this->render('site/bistro.html.twig',[
            'bistros' => $bistros
        ]);
    }

    /**
     * @Route("/expo", name="expo")
     */
    public function expo()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class);
        $expos = $articles->findBy(
            ['category' => 'expo']
        );

        return $this->render('site/expo.html.twig',[
            'expos' => $expos
        ]);
    }



    
}
