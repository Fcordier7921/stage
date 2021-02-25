<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class searchFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville', EntityType::class, [
                'label'=>'trier par ville :',
                'class'=> Apprenant::class,
                'choice_label' => 'ville',
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 20%;'
                ]
            ])
            ->add('mobilite', ChoiceType::class, [
                'label'=>'mobilité du stagiaire :',
                'choices'=>[
                    'oui'=>1,
                    'non'=>0
                ],
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 7%;'
                ]
            ])
            ->add('recherches', TextType::class, [
                'label'=>'recherche :',
                'required'   => false,
                'attr'=>[
                    'class'=> 'form-control mb-3',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr'=>[
                    'class'=> 'form-control mb-5',
                    'style'=> 'width: 10%;'
                ]
            ])
            ;
    }
}