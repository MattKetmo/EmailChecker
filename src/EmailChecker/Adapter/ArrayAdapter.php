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
 * Throwaway email adapter build with array.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class ArrayAdapter implements AdapterInterface
{
    protected $domains;

    /**
     * @param array $domains List of throwaway domains
     */
    public function __construct(array $domains)
    {
        $this->domains = $domains;
    }

    /**
     * {@ineritDoc}
     */
    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}