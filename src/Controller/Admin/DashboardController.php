<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Throw an AccessDeniedException if the user doesn't have the 'ROLE_ADMIN' role
            throw new AccessDeniedException('You are not authorized to access this page.');
        }

        $url = $this->adminUrlGenerator
            ->setController(CandidatsCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LuxuryServiceTP');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Candidats', 'fas fa-list', 'App\Entity\Candidats'::class);
         yield MenuItem::linkToCrud('Candidature', 'fas fa-list', 'App\Entity\Candidature'::class);
         yield MenuItem::linkToCrud('Client', 'fas fa-list', 'App\Entity\Client'::class);
         yield MenuItem::linkToCrud('Jobs', 'fas fa-list', 'App\Entity\Jobs'::class);
    }
}
