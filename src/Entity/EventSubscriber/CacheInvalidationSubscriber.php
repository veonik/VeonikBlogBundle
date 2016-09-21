<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Entity\EventSubscriber;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Filesystem\Filesystem;

class CacheInvalidationSubscriber implements EventSubscriber
{
    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var CacheProvider
     */
    private $cacheDir;

    /**
     * Constructor
     *
     * @param Filesystem $fs
     * @param string $cacheDir
     */
    public function __construct(Filesystem $fs, $cacheDir)
    {
        $this->fs = $fs;
        $this->cacheDir = $cacheDir;
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this->invalidateCache();
    }

    public function postPersist(LifecycleEventArgs $event)
    {
        $this->invalidateCache();
    }

    /**
     * Invalidates the result cache.
     */
    private function invalidateCache()
    {
        $this->fs->remove($this->cacheDir);
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(Events::postPersist, Events::postUpdate);
    }
}
