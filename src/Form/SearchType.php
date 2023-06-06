<?php

namespace App\Form;

use App\Entity\Searchdata;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Options;
use App\Entity\Property;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('options',EntityType::class,[
                'class'=>Options::class,
                'required'=>false,
                'multiple'=>true,
                'choice_label'=>'name',
                'label'=>false,
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
