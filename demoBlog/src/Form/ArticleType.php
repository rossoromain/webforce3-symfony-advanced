<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => "Exemple : Mon titre",
                    'class' => 'form-control'
                ],
                'label' => "Titre de l'article :"
            ])
            ->add('content', TextType::class, [
                'attr' => [
                    'placeholder' => "Exemple : Mon contenu",
                    'class' => 'form-control'
                ],
                'label' => "Contenu de l'article :"
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'placeholder' => "Exemple : Mon lien",
                    'class' => 'form-control'
                ],
                'label' => "URL de l'image de l'article :"
            ])
            /* ->add('createdAt') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
