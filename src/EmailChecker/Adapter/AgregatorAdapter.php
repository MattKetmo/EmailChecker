<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Adapter;

/**
 * Combine data from other adapters.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 *
 * @deprecated Use \EmailChecker\Adapter\AggregatorAdapter instead.
 */
class AgregatorAdapter extends AggregatorAdapter
{
    public function __construct(array $adapters)
    {
        parent::__construct($adapters);

        trigger_error(\sprintf(
            'Since mattketmo/email-checker 2.5.0: Class "%s" is deprecated, use "%s" instead.',
            self::class,
            AggregatorAdapter::class,
        ), \E_USER_DEPRECATED);
    }
}
