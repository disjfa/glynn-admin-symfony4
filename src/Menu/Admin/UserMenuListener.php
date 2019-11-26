<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureAdminMenu;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserMenuListener implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function onMenuConfigure(ConfigureAdminMenu $event)
    {
        $menu = $event->getMenu();
        $menu->addChild('users', [
            'route' => 'admin_user_index',
            'label' => $this->translator->trans('admin.menu.users'),
        ])->setExtra('icon', 'fa-users');
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureAdminMenu::class => ['onMenuConfigure', 50],
        ];
    }
}
