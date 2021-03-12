<?php

namespace App\Controller\Admin;

use App\Entity\AnnonceEntreprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class AnnonceEntrepriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnnonceEntreprise::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre'),
            TextEditorField::new('contenue'),
            TextField::new('specification'),
            BooleanField::new('etat_validation'),
            AssociationField::new('entreprise'),
        ];
    }
    
}
