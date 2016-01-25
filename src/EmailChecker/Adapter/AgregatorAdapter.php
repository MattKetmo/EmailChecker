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
class AgregatorAdapter implements AdapterInterface
{
    protected $adapters;

    /**
     * Build agregator adapter with a list of adpaters (order matters).
     *
     * @param array $adapters List of AdapterInterface objects
     */
    public function __construct(array $adapters)
    {
        foreach ($adapters as $adapter) {
            if (!$adapter instanceof AdapterInterface) {
                throw new \InvalidArgumentException(
                    'AgregatorAdapter only accept instances of AdapterInterface'
                );
            }
        }

        $this->adapters = $adapters;
    }

    /**
     * {@inheritdoc}
     */
    public function isThrowawayDomain($domain)
    {
        foreach ($this->adapters as $adapter) {
            if ($adapter->isThrowawayDomain($domain)) {
                return true;
            }
        }

        return false;
    }
}
