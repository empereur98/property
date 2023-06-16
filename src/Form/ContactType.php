<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre Nom'
                ]
            ])
            ->add('lastname',null,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre Prenom'
                ]
            ])
            ->add('email',EmailType::class,[
                'required'=>true,
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Email'
                ]
            ])
            ->add('contact',IntegerType::class,[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'Contact'
                ],
                'label'=>false,
            ])
            ->add('messages',TextareaType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'votre Messages'
                ],
                'required'=>false
            ])
            ->add('sauvegarder',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=>Contact::class
        ]);
    }
}