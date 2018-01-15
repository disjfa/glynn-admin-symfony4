<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardBundle extends Controller
{
    /**
     * @Route("/admin", name="dashboard_index")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig');
    }
}