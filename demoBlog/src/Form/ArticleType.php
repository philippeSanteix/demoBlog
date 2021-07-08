<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', textType::class,[
                
                    'attr'=> [
                        'placeholder' => "saisir le nom article"
                    ]
            ])

            ->add('contenu', TextareaType::class,[
                'label'=>"Contenu de l'article",
                'attr' => [
                    'placeholder' => "saisir l'article",
                    'rows'=> 5,
                    ]
            ])

            ->add('image', textType::class, [
                    'attr'=> [
                        'placeholder' => "saisir le nom article"
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
