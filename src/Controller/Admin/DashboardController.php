<?php

namespace App\Controller\Admin;

use App\Entity\Announcement;
use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Certification;
use App\Entity\Company;
use App\Entity\Enterprise;
use App\Entity\Member;
use App\Entity\Specialization;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Security Response');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Announcement', 'fas fa-newspaper', Announcement::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-newspaper', Category::class);
        yield MenuItem::linkToCrud('Company', 'fas fa-newspaper', Company::class);
        yield MenuItem::linkToCrud('Enterprise', 'fas fa-newspaper', Enterprise::class);
        yield MenuItem::linkToCrud('Answer', 'fas fa-newspaper', Answer::class);
        yield MenuItem::linkToCrud('Member', 'fas fa-newspaper', Member::class);
        yield MenuItem::linkToCrud('User', 'fas fa-newspaper', User::class);
        yield MenuItem::linkToCrud('Certification', 'fas fa-newspaper', Certification::class);
        yield MenuItem::linkToCrud('Specialization', 'fas fa-newspaper', Specialization::class);
    }
}
