<?php

namespace App\Controller\Admin;


use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnForms(),
            TextField::new('maintitle','Titre'),
            TextField::new('subtitle','Sous-titre'),
            UrlField::new('banner','Image entête')->onlyOnForms(),
            TextEditorField::new('description','Description')->onlyOnForms(),
            TextField::new('Client','name', 'commenditaire'),
            DateTimeField::new('date','Date de création')->onlyOnForms(),
            BooleanField::new('state', 'Etat')->onlyOnForms(),


        ];
    }
}