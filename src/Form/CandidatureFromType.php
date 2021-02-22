<?php

namespace App\Form;

use App\Entity\Candidature;
use App\Entity\Entreprise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatureFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', EntityType::class, [
                    'class'=> Entreprise::class,
                    'choice_label' => 'nom',
                    'attr'=>[
                        'class'=> 'form-control',
                        'style'=> 'width: 30%;'
                    ]
                ])
            ->add('date_candidature', DateType::class, [
                'label' => 'date de candidature',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
                ])
            ->add('date_relance', DateType::class, [
                'label' => 'date de relance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
                ])
            ->add('date_entretient', DateType::class, [
                'label' => "date de l'entretien",
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ]
                ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'En attente',
                    'Relancée' => 'Relancée',
                    'Positif' => 'Positif',
                    'Négatif' => 'Négatif',
                ],
                'choice_attr' => [
                    'Relancée' => ['data-color' => 'orange'],
                    'Positif' => ['data-color' => 'green'],
                    'Négatif' => ['data-color' => 'red'],
                ],
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
            'data_class' => Candidature::class,
        ]);
    }
}
