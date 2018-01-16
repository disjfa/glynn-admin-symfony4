<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\MatcherInterface;
use Knp\Menu\Matcher\Voter\RouteVoter;
use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MainBuilder.
 */
class AdminMenuBuilder
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var MenuFactory
     */
    private $factory;
    /**
     * @var MatcherInterface
     */
    private $matcher;

    /**
     * MainBuilder constructor.
     *
     * @param ContainerInterface $container
     * @param FactoryInterface   $factory
     * @param MatcherInterface   $matcher
     */
    public function __construct(ContainerInterface $container, FactoryInterface $factory, MatcherInterface $matcher)
    {
        $this->container = $container;
        $this->factory = $factory;
        $this->matcher = $matcher;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     */
    public function build(array $options)
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'sidebar-menu',
            ],
        ]);

        $menu->addChild('Dashboard', [
            'route' => 'admin_dashboard_index',
        ])->setExtra('icon', 'fa-tachometer');

        $this->container->get('event_dispatcher')->dispatch(
            ConfigureMenuEvent::CONFIGURE,
            new ConfigureMenuEvent($this->factory, $menu)
        );

        $this->matcher->addVoter(new RouteVoter($this->container->get('request_stack')->getMasterRequest()));
        $menu->setUri($this->container->get('request_stack')->getMasterRequest()->getUri());
        $this->setupMenuData($menu->getChildren());

        return $menu;
    }

    /**
     * @param MenuItem[] $children
     * @param bool       $hasCurrent
     *
     * @return bool
     */
    public function setupMenuData(array $children, $hasCurrent = false)
    {
        $childIndex = 0;
        foreach ($children as $child) {
            ++$childIndex;
            if (count($child->getChildren()) > 0) {
                $itemId = sprintf('menu-%d-%d', $child->getLevel(), $childIndex + 1);

                $child->setUri('#'.$itemId);
                $child->setAttribute('class', 'sidebar-sub');

                $child->setLinkAttribute('data-toggle', 'collapse');

                if ($this->matcher->isAncestor($child)) {
                    $child->setChildrenAttribute('class', 'sidebar-sub collapse show');
                    $child->setLinkAttribute('class', 'sidebar-link');
                } else {
                    $child->setLinkAttribute('class', 'sidebar-link collapsed');
                    $child->setChildrenAttribute('class', 'sidebar-sub collapse');
                }
                $child->setChildrenAttribute('id', $itemId);

                $this->setupMenuData($child->getChildren());
            } else {
                $child->setLinkAttribute('class', 'sidebar-link');
            }
        }

        return $hasCurrent;
    }
}
