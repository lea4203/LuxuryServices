<?php

namespace App\Controller\Admin;

use App\Entity\Candidats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidats::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('adress'),
            TextField::new('country'),
            TextField::new('nationality'),
            BooleanField::new('passport'),
            TextField::new('location'),
            DateTimeField::new('dateBirth'),
            TextField::new('placeBirth'),
            TextField::new('shortDescription'),
            TextField::new('notes'),
            BooleanField::new('availability'),
            DateTimeField::new('dateCreated'),
            DateTimeField::new('dateUpdated'),
            DateTimeField::new('dateDeleted'),

         
        ];
    }
}
