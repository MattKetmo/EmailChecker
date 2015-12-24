<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * Laravel Facade accessor.
 *
 * @author Oliver Green <dubious@codeblog.co.uk>
 */
class EmailCheckerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'email.checker';
    }
}
