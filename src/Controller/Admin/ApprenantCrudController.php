<?php

namespace App\Controller\Admin;

use App\Entity\Apprenant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ApprenantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Apprenant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('Users', "non d'utilisateur"),
            ImageField::new('Avatar', 'Photo')
            ->setBasePath ( '/uploads/brochures')
            ->setUploadDir('/public/uploads/brochures') ,
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('adress'),
            IntegerField::new('code_postal'),
            TextField::new('ville'),
            TextField::new('telephone'),
            EmailField::new('email'),
            UrlField::new('portfolio'),
            UrlField::new('cv'),
            UrlField::new('git'),
            DateTimeField::new('promo_anne'),
            TextField::new('promo_ville'),
            TextField::new('competences'),
            BooleanField::new('mobilit'),
            TextField::new('zone_geographique'),
            
        ];
    }

    public function configureActions(Actions $actions): Actions
        {
            return $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW)
            ;

        }
    
}
