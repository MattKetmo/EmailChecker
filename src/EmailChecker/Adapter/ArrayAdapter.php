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
    /**
     * @var array<string, int>
     */
    private array $domainSet;

    /**
     * @param string[] $domains List of throwaway domains
     */
    public function __construct(array $domains)
    {
        $this->domainSet = array_flip($domains);
    }

    public function isThrowawayDomain(string $domain): bool
    {
        return isset($this->domainSet[$domain]);
    }
}
