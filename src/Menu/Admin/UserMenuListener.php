<?php

namespace App\Menu\Admin;

use App\Entity\User;
use App\Menu\ConfigureMenuEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class UserMenuListener
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
        $userMenu = $menu->addChild('Users', [
            'route' => 'admin_user_index',
        ])->setExtra('icon', 'fa-users');
        $userMenu->addChild('Users', ['route' => 'admin_user_index'])->setExtra('icon', 'fa-users');
    }
}
