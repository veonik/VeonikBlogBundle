<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Controller;

use Orkestra\Bundle\ApplicationBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Veonik\Bundle\BlogBundle\Entity\Post;

/**
 * Comment controller.
 *
 * @Route("/post/{postid}/comment")
 */
abstract class AbstractBlogController extends Controller
{
    const CURRENT_AUTHOR_SESSION_KEY      = '__current_author_id';

    private $currentAuthor;

    protected function getCurrentAuthor()
    {
        if ($this->currentAuthor) {
            return $this->currentAuthor;
        }

        if ($this->getSession()->has(static::CURRENT_AUTHOR_SESSION_KEY)) {
            $this->currentAuthor = $this->getDoctrine()->getManager()->find('VeonikBlogBundle:Author', $this->getSession()->get(self::CURRENT_AUTHOR_SESSION_KEY));
        } else {
            $this->currentAuthor = $this->getDoctrine()
                ->getManager()
                ->getRepository('VeonikBlogBundle:Author')
                ->findOneBy(array('user' => $this->getUser()));
        }

        if (!$this->currentAuthor) {
            throw new \RuntimeException('This action requires that the current user be assigned to an author');
        }

        return $this->currentAuthor;
    }
}
