<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureAdminMenu;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslatorMenuListener implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(TranslatorInterface $translator, RouterInterface $router)
    {
        $this->translator = $translator;
        $this->router = $router;
    }

    public function onMenuConfigure(ConfigureAdminMenu $event)
    {
        if (null === $this->router->getRouteCollection()->get('translation_index')) {
            return;
        }

        $menu = $event->getMenu();
        $menu->addChild('translations', [
            'route' => 'translation_index',
            'label' => $this->translator->trans('admin.menu.translations'),
        ])->setExtra('icon', 'fa-language');
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureAdminMenu::class => ['onMenuConfigure', -150],
        ];
    }
}
