<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
     * @return true for a throwaway domain
     */
    public function isThrowawayDomain($domain);
}
