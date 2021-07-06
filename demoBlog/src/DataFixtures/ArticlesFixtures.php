<?php

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i =1;$i <= 11 ; $i++)
        {
            $article = new Article;
            $article->setTitle("Titre de l'article $i")
                    ->setContenu("<p>lLe Lorem Ipsum est simplement du faux texte employé dans la composition 
                    et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie 
                    depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser
                     un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles,
                      mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit </p>")
                    ->setImage("https://picsum.photos/seed/picsum/200/300")
                    ->setDate(new \DateTime());

            $manager -> persist($article);
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