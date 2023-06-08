<?php

namespace App\Form;

use App\Entity\Options;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat',ChoiceType::class,[
                'choices'=>$this->getChoice()
            ])
            ->add('city')
            ->add('address')
            ->add('post')
            ->add('sold')
            ->add('created_at')
            ->add('options',EntityType::class,[
                'class'=>Options::class,
                'multiple'=>true,
                'choice_label'=>'name',
                'required'=>false
            ])
            ->add('imageFile',FileType::class,[
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain'=>'forms'
        ]);
    }
    public function getChoice():array{
        $tab=[];
        foreach (Property::HEAD as $key => $value) {
            $tab[$value]=$key;
        }
        return $tab;
    }
}
