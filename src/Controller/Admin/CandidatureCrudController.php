<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
            AssociationField::new('candidat'),
            AssociationField::new('jobs'),
            TextField::new('status'),
            DateTimeField::new('submitAt'),
        ];
    }
  
}
