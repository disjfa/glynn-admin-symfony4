<?php

namespace App\Dashboard;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\Event;
use Twig_Environment;

class ConfigureDashboardEvent extends Event
{
    const NAME = 'admin.dashboard_items';

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var ArrayCollection
     */
    private $items;

    /**
     * ConfigureDashboardEvent constructor.
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->items = new ArrayCollection();
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
