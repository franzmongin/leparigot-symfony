<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\User;

class SiteController extends AbstractController
{

    /**
     * @Route("add_to_list/{id}", name="add_to_list", requirements={"id":"\d+"})
     * 
     */
    public function addToList(Article $article):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $user->addArticle($article);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['code' => 200], 200);
    }

    /**
     * @Route("remove_to_list/{id}", name="remove_to_list", requirements={"id":"\d+"})
     * 
     */
    public function removeToList(Article $article):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $user->removeArticle($article);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['code' => 200], 200);
    }

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
        $user = $this->getUser();
        if ($this->getUser()){
            $user_articles = $user->getArticles();
            $user_articles_ids = [];
            foreach($user_articles as $user_article)
            {
                $user_articles_ids[] = $user_article->getId();
            }
        }
        else{
            $user_articles = null;
            $user_articles_ids = null;
        }
        

            

        return $this->render('site/home.html.twig', [
            'restos' => $restos,
            'bistros' => $bistros,
            'expos' => $expos,
            'user' => $user,
            'user_articles' => $user_articles,
            'user_articles_ids' => $user_articles_ids
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
        $user = $this->getUser();
        if ($this->getUser()){
            $user_articles = $user->getArticles();
            $user_articles_ids = [];
            foreach($user_articles as $user_article)
            {
                $user_articles_ids[] = $user_article->getId();
            }
        }
        else{
            $user_articles = null;
            $user_articles_ids = null;
        }

        return $this->render('site/resto.html.twig',[
            'restos' => $restos,
            'user' => $user,
            'user_articles' => $user_articles,
            'user_articles_ids' => $user_articles_ids
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
        $user = $this->getUser();
        if ($this->getUser()){
            $user_articles = $user->getArticles();
            $user_articles_ids = [];
            foreach($user_articles as $user_article)
            {
                $user_articles_ids[] = $user_article->getId();
            }
        }
        else{
            $user_articles = null;
            $user_articles_ids = null;
        }

        return $this->render('site/bistro.html.twig',[
            'bistros' => $bistros,
            'user' => $user,
            'user_articles' => $user_articles,
            'user_articles_ids' => $user_articles_ids
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
        $user = $this->getUser();
        if ($this->getUser()){
            $user_articles = $user->getArticles();
            $user_articles_ids = [];
            foreach($user_articles as $user_article)
            {
                $user_articles_ids[] = $user_article->getId();
            }
        }
        else{
            $user_articles = null;
            $user_articles_ids = null;
        }

        return $this->render('site/expo.html.twig',[
            'expos' => $expos,
            'user' => $user,
            'user_articles' => $user_articles,
            'user_articles_ids' => $user_articles_ids
        ]);
        
    }

    /**
     * @Route("/ma_liste", name="ma_liste")
     */
    public function liste()
    {
        $user = $this->getUser();
        $articles = $user->getArticles();

        return $this->render('site/liste.html.twig',[
            'articles' => $articles,
            'user' => $user
        ]);
    }



    
}
