<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adress')
            ->add('code_postal')
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('portfolio')
            ->add('git')
            ->add('cv')
            ->add('promo_anne')
            ->add('promo_ville')
            ->add('avatar',ElFinderType::class, ['instance' => 'form', 'enable' => true])
            ->add('competences')
            ->add('mobilit')
            ->add('zone_geographique')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
