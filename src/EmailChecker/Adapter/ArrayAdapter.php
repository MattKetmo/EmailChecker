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
     * {@inheritdoc}
     */
    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}
