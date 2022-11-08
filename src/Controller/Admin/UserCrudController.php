<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(TextFilter::new('email', 'Email'));
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield EmailField::new('email', 'Email'),
            yield TextField::new('username', 'Pseudo'),
            yield ArrayField::new('roles'),
            yield TextField::new('password', 'Mot de passe'),
            yield AssociationField::new('userMember', 'Membre')
                ->setCrudController(MemberCrudController::class),
            yield AssociationField::new('userEnterprise', 'Entreprise')
                ->setCrudController(EnterpriseCrudController::class),
            yield AssociationField::new('userCompany', 'Company')
                ->setCrudController(CategoryCrudController::class),
            yield BooleanField::new('is_verified', 'Vérifié'),


        ];
    }
}
