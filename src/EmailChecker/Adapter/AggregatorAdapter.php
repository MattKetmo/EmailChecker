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
 */
final class AggregatorAdapter implements AdapterInterface
{
    /**
     * Build aggregator adapter with a list of adapters (order matters).
     *
     * @param AdapterInterface[] $adapters List of AdapterInterface objects
     */
    public function __construct(private array $adapters)
    {
    }

    public function isThrowawayDomain(string $domain): bool
    {
        foreach ($this->adapters as $adapter) {
            if ($adapter->isThrowawayDomain($domain)) {
                return true;
            }
        }

        return false;
    }
}
