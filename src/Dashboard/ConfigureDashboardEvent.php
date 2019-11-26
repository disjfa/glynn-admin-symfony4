<?php

namespace App\Dashboard;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\EventDispatcher\Event;
use Twig\Environment;

class ConfigureDashboardEvent extends Event
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ArrayCollection
     */
    private $items;

    /**
     * ConfigureDashboardEvent constructor.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->items = new ArrayCollection();
    }

    /**
     * @return Environment
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
