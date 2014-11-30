<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Orkestra\Common\Entity\AbstractEntity;

/**
 * A comment
 *
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @var \Veonik\Bundle\BlogBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Veonik\Bundle\BlogBundle\Entity\AbstractPost", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;

    /**
     * @var \Veonik\Bundle\BlogBundle\Entity\Author
     *
     * @ORM\ManyToOne(targetEntity="Veonik\Bundle\BlogBundle\Entity\Author", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @param \Veonik\Bundle\BlogBundle\Entity\Author $author
     */
    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    /**
     * @return \Veonik\Bundle\BlogBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \Veonik\Bundle\BlogBundle\Entity\AbstractPost $post
     */
    public function setPost(AbstractPost $post)
    {
        $this->post = $post;
    }

    /**
     * @return \Veonik\Bundle\BlogBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
