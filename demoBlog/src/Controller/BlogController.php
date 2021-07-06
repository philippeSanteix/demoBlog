<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        
        $repoArticles = $this ->getDoctrine()->getRepository(Article::class);
        dump($repoArticles);
        
        $articles=$repoArticles->findAll();
        dump($articles);
        
        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }


    /**
     * @route("/", name="home")
     * 
     */
    public function home(): Response
    {
        return $this ->render('blog/home.html.twig',[
            'title'=>'Blod dédié à la Music, viendez ça déchire grâve',
            'age'=>25
        ]);
    }


    /**
     *methode permetant d'afficher le detail d'un article 
    * 
    * @Route("/blog/12", name="blog_show")
    */
    public function show(): Response
    {
        return $this ->render('blog/show.html.twig');
    }

    



}