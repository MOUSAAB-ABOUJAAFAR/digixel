<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Name :',
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Name..'],
            ])
            ->add('Description', TextType::class, [
                'label' => 'Description :',
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Déscription..'],
            ])
            ->add('Price', NumberType::class, [
                'empty_data' => '',
                'label' => 'Price ($) :',
                'scale'    => 2,
                'attr'     => array(
                    'min'  => 0,
                    'max'  => 9999.99,
                    'step' => 0.01,
                    'placeholder' => 'Price..'
                ),
                'html5' => true
            ])
            ->add('Image', TextType::class, [
                'attr' => ['class' => 'custom-css-class'],
                'label_attr' => array('class' => 'label-img'),

            ])
            
            ->add(
                'Categories',
                EntityType::class,
                [
                    'placeholder' => 'Select Categorie..',
                    'class' => 'App\Entity\Categories',
                    'label' => 'Categorie :',
                    'empty_data' => ''
                   
                ],
                
            );
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
