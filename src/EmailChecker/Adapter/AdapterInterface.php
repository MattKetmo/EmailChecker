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
 * Adapter used to check throwaway domains.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
interface AdapterInterface
{
    /**
     * Checks if an email domain is throwaway.
     *
     * @param string $domain The domain to check
     *
     * @return bool True for a throwaway domain
     */
    public function isThrowawayDomain($domain);
}
