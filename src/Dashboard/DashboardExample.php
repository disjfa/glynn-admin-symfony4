<?php

namespace App\Dashboard;

use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

class DashboardExample
{
    /**
     * @param ConfigureDashboardEvent $event
     *
     * @return string
     *
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function get($event)
    {
        $items = $event->getItems();
        $twig = $event->getTwig();
        $items->add($twig->render('admin/dashboard/example.html.twig'));
    }
}
