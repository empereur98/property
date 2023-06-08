<?php

namespace App\Form;

use App\Entity\Searchdata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice',IntegerType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'prix maximale'
                ]
            ])
            ->add('minSurface',IntegerType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=>[
                'placeholder'=>'Surface Minimale']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Searchdata::class,
            'method'=> 'get'
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
