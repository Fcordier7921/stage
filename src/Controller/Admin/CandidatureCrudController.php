<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            AssociationField::new('apprenant'),
            DateTimeField::new('date_candidature'),
            DateTimeField::new('date_relance'),
            DateTimeField::new('date_entretient'),
            TextField::new('statut'),
            AssociationField::new('entreprise'),
        ];
    }

    public function configureActions(Actions $actions): Actions
        {
            return $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW)
            ;

        }
    
}
