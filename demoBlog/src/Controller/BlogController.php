<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $repoArticles): Response
    {
        
        //$repoArticles = $this ->getDoctrine()->getRepository(Article::class);
        dump($repoArticles);
        
        $articles=$repoArticles->findAll();
        dump($articles);
        
        return $this->render('blog/blog.html.twig', [
            'articlesBDD'=> $articles,
        ]);
    }


    /**
     * @Route("/", name="home")
     */
        public function home(): Response
        {
            return $this ->render('blog/home.html.twig',[
            'title'=>'Blod dédié à la Music, viendez ça déchire grâve',
            'age'=>25
            ]);
        }
    /**
    * @Route("/blog/new", name="blog_create")
    */
        public function create(): Response
        {
                return $this->render('blog/create.html.twig');
        }


    /**
     *methode permetant d'afficher le detail d'un article 
    * 
    * @Route("/blog/{id}", name="blog_show")
    */
    public function show(Article $article): Response 
    {
          //  dump ($id);
       // $repoArticle = $this ->getDoctrine()->getRepository(Article::class);
        //    dump($repoArticle); 

       // $article = $repoArticle->find($id);
            dump($article);

        return $this ->render('blog/show.html.twig', ['articleBDD'=>$article]);
    }

        


 }