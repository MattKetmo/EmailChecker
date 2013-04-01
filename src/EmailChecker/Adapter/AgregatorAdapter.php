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
        $this->adapters = $adapters;
    }

    /**
     * {@ineritDoc}
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