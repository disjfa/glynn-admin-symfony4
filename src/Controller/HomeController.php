<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/dos", name="home_dos")
     */
    public function dos()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/tres", name="home_tres")
     */
    public function tres()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/offline.html", name="home_offline")
     */
    public function offline()
    {
        return $this->render('home/offline.html.twig');
    }
}
