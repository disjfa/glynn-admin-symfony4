<?php

namespace App\Menu\Site;

use Disjfa\MenuBundle\Menu\ConfigureSiteMenu;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeMenuListener implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * HomeMenuListener constructor.
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function onMenuConfigure(ConfigureSiteMenu $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('home', [
            'route' => 'home_index',
            'label' => $this->translator->trans('site.menu.home'),
        ])->setExtra('icon', 'fa-home');
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureSiteMenu::class => ['onMenuConfigure', 999],
        ];
    }
}
