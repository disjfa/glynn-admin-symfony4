<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="admin_dashboard_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('dashboard/index.html.twig');
    }
}
