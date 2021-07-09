<?php

namespace App\DataFixtures;


use DateTime;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $faker = \Faker\Factory::create('fr_FR');

      for($cat = 1; $cat <=3; $cat++)
      {
          $category= new Category;
          
          $category -> setTitre($faker->word)
                    -> setDescription($faker-> paragraph());
                    
          $manager->persist($category);
      // creation de 4 à 10 articles par catégorie
          for($art=1; $art <= mt_rand(4,10); $art++)
          {
            //$faker->paragraphs(5)retourne un array alors "join" permet d'extraire une chaine de paragraphe afin de constituer une chaine avec separateur 
            $contenu = '<p>'. join($faker->paragraphs(5), '</p><p>' ) .'</p>';
            
            $article = new Article;
            $article->setTitle($faker->sentence())
                    ->setContenu($contenu)
                    ->setImage($faker->imageUrl(600,600))
                    ->setDate($faker->dateTimeBetween('-6months'))
                    ->setCategory($category);
            
            $manager->persist($article);
          
              //creation de 4 à 10 commentaire pour chaque article
              for($cmt=1; $cmt <= mt_rand(4,10); $cmt++)
              {
                
                $now = new DateTime;
                $interval=$now->diff($article->getDate());
                $days = $interval->days;
                $minimum = "-$days days";
                
                $contenu = '<p>'. join($faker->paragraphs(5), '</p><p>' ) .'</p>';

                $comment = new Comment;
                $comment ->setAuteur($faker->name)
                          ->setCommentaire($contenu)
                          ->setDate($faker->dateTimeBetween($minimum))
                          ->setArticle($article);
                $manager->persist($comment);

              }

          }
      }

      $manager->flush();
  }
}

/* Un manager (ObjectManager) en Symfony est un classe permettant, entre autre,
 de manipuler les lignes de la BDD (INSERT, UPDATE, DELETE)

  // persist() : méthode issue de la classe ObjectManager permettant de préaprer
   et de garder en méméoire les requetes d'insertion
 // $data = $bdd->prepare("INSERT INTO article VALUES ('getTitre()', 'getContenu()' etc...)")
           
   // persist() : méthode issue de la classe ObjectManager 
   permettant véritablement d'executer les requetes d'insertions en BDD
   // flush() : méthode issue de la classe ObjectManager permettant véritablement
    d'executer les requetes d'insertions en BDD*/