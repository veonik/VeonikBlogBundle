<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A page
 *
 * @ORM\Entity(repositoryClass="Veonik\Bundle\BlogBundle\Entity\Repository\PostRepository")
 */
class Page extends AbstractPost
{

}
