<?php

namespace App\Dashboard;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class DashboardExample implements EventSubscriberInterface
{
    /**
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function get(ConfigureDashboardEvent $event)
    {
        $items = $event->getItems();
        $twig = $event->getTwig();
        $items->add($twig->render('admin/dashboard/example.html.twig'));
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureDashboardEvent::class => 'get',
        ];
    }
}
