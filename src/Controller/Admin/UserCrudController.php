<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            EmailField::new('email'),
            ChoiceField::new('roles')
                    ->allowMultipleChoices()
                    ->autocomplete()
                    ->setChoices(['ADMIN' => 'ROLE_ADMIN','ENTREPRISE'=>'ROLE_ENTREPRISE',
            'APPRENANT'=>'ROLE_APPRENANT']),
            TextField::new('password')->onlyWhenCreating()
            
        ];
        
    }

    public function configureActions(Actions $actions): Actions
        {
            return $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW)
            ;

        }
}
