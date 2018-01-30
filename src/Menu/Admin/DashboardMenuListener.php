<?php

namespace App\Menu\Admin;

use App\Entity\User;
use App\Menu\ConfigureMenuEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class DashboardMenuListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var User
     */
    private $user;

    /**
     * MediaMenuListener constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param Security               $security
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        if (null !== $security->getToken() && $security->getToken()->getUser() instanceof User) {
            $this->user = $security->getToken()->getUser();
        }
    }

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->addChild('Dashboard', [
            'route' => 'admin_dashboard_index',
        ])->setExtra('icon', 'fa-tachometer');
    }
}
