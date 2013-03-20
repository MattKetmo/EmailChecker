<?php

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
