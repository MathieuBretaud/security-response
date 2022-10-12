<?php

namespace App\Controller\Admin;

use App\Entity\Announcement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class AnnouncementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Announcement::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(TextFilter::new('title', 'Titre'));
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Annonces')
            ->setEntityLabelInSingular('Annonce')
            ->setDefaultSort(['title' => 'asc']);
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
