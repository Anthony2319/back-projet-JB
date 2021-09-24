<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Image;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ProjectCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Menu d\'Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Home', 'fa fa-home');
        yield MenuItem::linkToCrud('Project', 'far fa-folder', Project::class);
        yield MenuItem::linkToCrud('Category', 'far fa-list-alt', Category::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-user-circle', Client::class);
        yield MenuItem::linkToCrud('Image', 'fas fa-camera-retro', Image::class);
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-reply', 'homepage');
    }
}
