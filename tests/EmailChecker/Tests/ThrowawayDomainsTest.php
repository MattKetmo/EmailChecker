<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Tests;

use EmailChecker\ThrowawayDomains;

class ThrowawayDomainsTest extends TestCase
{
    public function testIsInstanciable()
    {
        $domains = new ThrowawayDomains();

        $this->assertInternalType('array', $domains->toArray());
        $this->assertInstanceOf('\ArrayIterator', $domains->getIterator());
        $this->assertGreaterThan(0, count($domains));
    }
}
