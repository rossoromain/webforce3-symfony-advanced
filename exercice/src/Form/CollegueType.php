<?php

namespace App\Form;

use App\Entity\Collegue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollegueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    /* 'placeholder' => "Exemple : Rosso" ,*/
                    'class' => 'form-control'
                ],
                'label' => "Nom du collègue :"
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    /* 'placeholder' => "Exemple : Romain ",*/
                    'class' => 'form-control'
                ],
                'label' => "Prénom du collègue :"
            ])
            ->add('wages', IntegerType::class, [
                'attr' => [
                    /* 'placeholder' => "Exemple : 3000", */
                    'class' => 'form-control'
                ],
                'label' => "Salaire du collègue :"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collegue::class,
        ]);
    }
}
