<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureAdminMenu;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DashboardMenuListener implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * MediaMenuListener constructor.
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function onMenuConfigure(ConfigureAdminMenu $event)
    {
        $menu = $event->getMenu();
        $menu->addChild('dashboard', [
            'label' => $this->translator->trans('admin.menu.dashboard'),
            'route' => 'admin_dashboard_index',
        ])->setExtra('icon', 'fa-tachometer-alt');
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureAdminMenu::class => ['onMenuConfigure', 999],
        ];
    }
}
