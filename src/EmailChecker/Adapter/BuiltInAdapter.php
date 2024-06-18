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

use EmailChecker\ThrowawayDomains;

/**
 * Built-in adapter.
 *
 * This adapter provides a list of throwaway domains included in that library.
 * Initially, those domains come from FGRibreau/mailchecker library.
 *
 * @see https://github.com/FGRibreau/mailchecker/blob/master/list.json
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class BuiltInAdapter implements AdapterInterface
{
    protected $domains;

    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->getDomains());
    }

    private function getDomains()
    {
        if (null === $this->domains) {
            $this->domains = (new ThrowawayDomains())->toArray();
        }

        return $this->domains;
    }
}
