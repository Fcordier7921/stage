<?php

namespace App\Form;

use App\Entity\Apprenant;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('adress', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('code_postal', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('telephone', TelType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('portfolio', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('git', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('cv', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('promo_anne', DateType::class, [
                'attr'=>[
                    
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('promo_ville', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('avatar', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('competences', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('mobilit', CheckboxType::class, [
                'label' => 'Etes vous mobile: '
            ])
            ->add('zone_geographique', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
