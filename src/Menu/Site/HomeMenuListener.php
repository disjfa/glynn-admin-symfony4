<?php

namespace App\Menu\Site;

use App\Menu\ConfigureMenuEvent;

class HomeMenuListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('home', [
            'route' => 'home_index',
            'label' => 'Home',
        ])->setExtra('icon', 'fa-home');
    }
}
