<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle;

use Orkestra\Common\Type\Date;
use Orkestra\Common\Type\DateTime;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class VeonikBlogBundle extends Bundle
{
    public function boot()
    {
        DateTime::setDefaultFormat('m/d/Y');
        Date::setDefaultFormat('m/d/Y');
    }
}
