<?php

namespace App\Controller;


use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardUserController extends AbstractDashboardController
{
   /**
     * @Route("/user_dashboard", name="user")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser()->getEmail();
        } else {
            $user = '';
            return $this->redirectToRoute('account');
        }
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E_chry');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Products', 'fas fa-tags', Product::class);
        
    }
}
