<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Model\MenuBuilder;

/**
 * A menu builder for menus inside of header (h1, h2, etc) elements.
 */
class HeaderMenuBuilder implements MenuBuilderInterface
{
    /**
     * Get the name of this menu builder
     *
     * @return string
     */
    public function getName()
    {
        return 'header';
    }

    /**
     * Get the name of the template to be used for this builder
     *
     * @return string
     */
    public function getTemplateName()
    {
        return 'VeonikBlogBundle:Menu:header.html.twig';
    }
}
