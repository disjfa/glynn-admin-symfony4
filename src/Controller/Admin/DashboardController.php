<?php

namespace App\Controller\Admin;

use App\Dashboard\ConfigureDashboardEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig_Environment;

/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * DashboardController constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param Twig_Environment         $twig
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, Twig_Environment $twig)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->twig = $twig;
    }

    /**
     * @Route("/dashboard", name="admin_dashboard_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $dashboardItems = $this->eventDispatcher->dispatch(
            ConfigureDashboardEvent::NAME,
            new ConfigureDashboardEvent($this->twig)
        );

        return $this->render('admin/dashboard/index.html.twig', [
            'dashboardItems' => $dashboardItems,
        ]);
    }
}
