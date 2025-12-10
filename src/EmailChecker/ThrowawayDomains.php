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

use EmailChecker\Adapter\AggregatorAdapter;
use Fgribreau\MailChecker;

/**
 * List of built-in throwaway domains read from the resources folder.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 *
 * @implements \IteratorAggregate<string>
 *
 * @deprecated
 */
class ThrowawayDomains implements \IteratorAggregate, \Countable
{
    /**
     * @var string[]
     */
    protected $domains;

    public function __construct()
    {
        $content = file_get_contents(__DIR__.'/../../res/throwaway_domains.txt');
        if (false === $content) {
            throw new \LogicException('File "throwaway_domains.txt" not found');
        }

        trigger_error(\sprintf(
            'Since mattketmo/email-checker 2.5.0: Class "%s" is deprecated.',
            self::class,
        ), \E_USER_DEPRECATED);

        $this->domains = Utilities::parseLines($content);
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
