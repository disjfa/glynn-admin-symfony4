<?php

namespace App\Menu\Admin;

use Disjfa\MenuBundle\Menu\ConfigureMenuEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

class TranslatorMenuListener
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * MediaMenuListener constructor.
     *
     * @param TranslatorInterface $translator
     * @param RouterInterface     $router
     */
    public function __construct(TranslatorInterface $translator, RouterInterface $router)
    {
        $this->translator = $translator;
        $this->router = $router;
    }

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
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
}
