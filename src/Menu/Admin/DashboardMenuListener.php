<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureMenuEvent;
use Symfony\Component\Translation\TranslatorInterface;

class DashboardMenuListener
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

    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->addChild('dashboard', [
            'label' => $this->translator->trans('admin.menu.dashboard'),
            'route' => 'admin_dashboard_index',
        ])->setExtra('icon', 'fa-tachometer-alt');
    }
}
