<?php

namespace App\Controller\Admin;

use App\Entity\Enterprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnterpriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enterprise::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
