<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EntrepriseFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre nom",
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre non doit avoir au minimum {{ limit }} caratere',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('adress', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre adress",
                    ])
                ],
            ])
            ->add('code_postal', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre code postal",
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre code postal doit avoir au minimum {{ limit }} caratere',
                        // max length allowed by Symfony for security reasons
                        'max' => 6,
                    ]),
                ],
            ])
            ->add('ville', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre nom de ville",
                    ])
                ],
            ])
            ->add('telephone', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre numéro de téléphone",
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Votre numéro de léléphone doit avoir au minimum {{ limit }} chifrre',
                        // max length allowed by Symfony for security reasons
                        'max' => 20,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre Email",
                    ])
                ],
            ])
            ->add('site_net', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre lien vers votre page web",
                    ])
                ],
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
