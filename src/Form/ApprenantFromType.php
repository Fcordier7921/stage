<?php

namespace App\Form;
use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ApprenantFromType extends AbstractType
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
            ->add('prenom', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre prénom",
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit avoir au minimum {{ limit }} caratere',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
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
            ->add('portfolio', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre lien vers votre portefolio",
                    ])
                ],
            ])
            ->add('git', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre lien vers votre github",
                    ])
                ],
            ])
            ->add('cv', UrlType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre lien vers votre cv",
                    ])
                ],
            ])
            ->add('promo_anne', DateType::class, [
                'attr'=>[
                    
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre l'anné de votre promotion",
                    ])
                ],
            ])
            ->add('promo_ville', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entré votre la ville du centre de formation",
                    ])
                ],
            ])
            ->add('avatar', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
        
            ])
            ->add('competences', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'style'=> 'width: 30%;'
                ],
            ])
            ->add('mobilit', CheckboxType::class, [
                'label' => 'Etes vous mobile: ',
                'required' => false,
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
