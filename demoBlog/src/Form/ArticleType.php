<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', textType::class,[
                    'required'=> false,
                    'attr'=> [
                        'placeholder' => "saisir le nom article",
                        
                    ]
            ])

            ->add('category', EntityType::class,[
                'class'=> Category::class,
                'choice_label'=> 'titre'
            ])

            ->add('contenu', TextareaType::class,[
                'required'=> false,
                'label'=>"Contenu de l'article",
                'attr' => [
                    'placeholder' => "saisir l'article",
                    'rows'=> 5,
                    
                    ]
            ])

            ->add('image', textType::class, [
                'required'=> false,   
                'attr'=> [
                        'placeholder' => "saisir le url de image"
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,

        ]);
    }
}
