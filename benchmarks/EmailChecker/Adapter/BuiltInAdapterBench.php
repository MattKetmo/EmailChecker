<?php

namespace EmailChecker\Adapter;

use EmailChecker\Adapter\BuiltInAdapter;

class BuiltInAdapterBench
{
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchThrowawayDomain()
    {
        $adapter = new BuiltInAdapter();
        $adapter->isThrowawayDomain('foo@yopmail.com');
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchNotThrowawayDomain()
    {
        $adapter = new BuiltInAdapter();
        $adapter->isThrowawayDomain('foo@example.org');
    }
}
