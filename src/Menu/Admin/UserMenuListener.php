<?php

namespace App\Menu\Admin;

use App\Menu\ConfigureMenuEvent;
use Symfony\Component\Translation\TranslatorInterface;

class UserMenuListener
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * MediaMenuListener constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->addChild('users', [
            'route' => 'admin_user_index',
            'label' => $this->translator->trans('menu.users', [], 'admin'),
        ])->setExtra('icon', 'fa-users');
    }
}
