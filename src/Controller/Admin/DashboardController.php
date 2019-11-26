<?php

namespace App\Controller\Admin;

use App\Dashboard\ConfigureDashboardEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

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
     * @var Environment
     */
    private $twig;

    /**
     * DashboardController constructor.
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, Environment $twig)
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
