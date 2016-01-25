<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker;

/**
 * List of built-in throwaway domains read from the resources folder.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class ThrowawayDomains implements \IteratorAggregate, \Countable
{
    public function __construct()
    {
        $this->domains = Utilities::parseLines(file_get_contents(
            __DIR__.'/../../res/throwaway_domains.txt'
        ));
    }

    public function toArray()
    {
        return $this->domains;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count()
    {
        return count($this->domains);
    }
}
