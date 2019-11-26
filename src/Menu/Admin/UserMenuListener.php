<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureMenuEvent;
use Symfony\Component\Translation\TranslatorInterface;

class UserMenuListener
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
        $menu->addChild('users', [
            'route' => 'admin_user_index',
            'label' => $this->translator->trans('admin.menu.users'),
        ])->setExtra('icon', 'fa-users');
    }
}
