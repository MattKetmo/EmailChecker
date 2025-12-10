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

use Fgribreau\MailChecker;

/**
 * List of built-in throwaway domains coming from fgribreau/mailchecker.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 *
 * @implements \IteratorAggregate<string>
 */
class ThrowawayDomains implements \IteratorAggregate, \Countable
{
    /**
     * @var string[]
     */
    protected $domains;

    public function __construct()
    {
        $this->domains = MailChecker::blacklist();
    }

    /**
     * @return string[]
     */
    public function toArray()
    {
        return $this->domains;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count(): int
    {
        return count($this->domains);
    }
}
