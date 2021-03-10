<?php

namespace App\Form;

use App\Entity\AnnonceEntreprise;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceEFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label'=>'titre :',
                'attr'=>[
                    'class'=> 'form-control mb-3',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('contenue', CKEditorType::class, [
                'label'=>'Contenu de votre offre de stage :',
            ])
            ->add('specification', TextType::class, [
                'label'=>'specification :',
                'attr'=>[
                    'class'=> 'form-control mb-3',
                    'style'=> 'width: 30%;'
                ]
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AnnonceEntreprise::class,
        ]);
    }
}
