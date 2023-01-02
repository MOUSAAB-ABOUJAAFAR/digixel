<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TypeTextType::class, [
                'label' => 'Name :',
                'empty_data' => '',
                'attr' => [
                'placeholder' => 'Name..'
],
                
            ])
            ->add('Description',TextareaType::class, [
                'label' => 'Déscription :',
                'empty_data' => '',
                'attr' => ['rows' => '6',
                'placeholder' => 'Déscription...'],
                

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
