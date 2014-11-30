<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Entity\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Veonik\Bundle\BlogBundle\Entity\Menu;
use Veonik\Bundle\BlogBundle\Model\MenuBuilder\MenuBuilderRegistry;

class MenuPostLoadSubscriber implements EventSubscriber
{
    /**
     * @var MenuBuilderRegistry
     */
    private $builderRegistry;

    /**
     * Constructor
     *
     * @param MenuBuilderRegistry $builderRegistry
     */
    public function __construct(MenuBuilderRegistry $builderRegistry)
    {
        $this->builderRegistry = $builderRegistry;
    }

    /**
     * Injects the associated MenuBuilder for each Menu
     *
     * @param LifecycleEventArgs $event
     */
    public function postLoad(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (! ($entity instanceof Menu)) {
            return;
        }

        $builder = $this->builderRegistry->getBuilder($entity->getType());
        $entity->setBuilder($builder);
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(Events::postLoad);
    }
}
