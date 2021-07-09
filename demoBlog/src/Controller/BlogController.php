<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'title'=>'The Blog Dédié à The + Meilleur Music, C IcI',
            'age'=>25
            ]);
        }
//___________- premiere methode_________________________________

    /**
    * @Route("/blog/new_old", name="blog_create_old")
    */
        public function createOld(Request $request, EntityManagerInterface $manager): Response
        {
                dump($request);
                if($request->request->count()>0)
                {
                    $article=new Article;
                    $article->setTitle($request->request->get('title'))
                            ->setContenu($request->request->get('contenu'))
                            ->setImage($request->request->get('image'))
                            ->setDate(new \DateTime());
                    dump($article);

                    $manager->persist($article);
                    $manager->flush();

                    return $this->redirectToRoute('blog_show',[
                        'id'=> $article->getId()
                    ]);
                }
                return $this->render('blog/create.html.twig');
        }
//_________________deuxieme methode________________________________________




    /**
    * @Route("/blog/new", name="blog_create")
    * @Route("/blog/{id}/edit", name="blog_edit")
    */
       public function create(Article $article = null, Request $request, EntityManagerInterface $manager):Response 
        {
         if(!$article)
         {
            $article = new Article;
         } 

            dump($request);
            //"ArticleType" est le nom de la classe determiné dans la consol à la creation : php bin/console make:form
            $formArticle = $this->createForm(ArticleType ::class, $article);
            $formArticle->handleRequest($request);
            dump($article);

            if($formArticle->isSubmitted() && $formArticle -> isValid())
            {
                if(!$article->getId())
                {
                    $article->setDate(new \DateTime());
                }

                $article->setDate(new \DateTime());
                $manager->persist($article);
                $manager->flush();

                return $this->redirectToRoute('blog_show',[
                    'id' => $article->getId()
                ]);
            }

            return $this->render('blog/create2.html.twig',[
                'formArticle'=> $formArticle ->createView(),
                'editMode'=> $article->getId()
            ]);   
        }


    /**
     *methode permetant d'afficher le detail d'un article en fonction de son "id"
    * 
    * @Route("/blog/{id}", name="blog_show")
    */
        public function show(Article $article, Request $request): Response 
        {
            //TRAITEMENT COMMENTAIRE ARTICLE
            $comment = new Comment;
            $formComment = $this->createForm(CommentType::class, $comment);

            $formComment->handleRequest($request);
            dump($request);
            
            
            return $this ->render('blog/show.html.twig', [
                'articleBDD'=>$article,
                'formComment'=> $formComment -> createView()
            ]);
        }

        


 }