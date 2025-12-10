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

final class ThrowawayDomainsTest extends TestCase
{
    public function testIsInstanciable(): void
    {
        $domains = new ThrowawayDomains();

        $this->assertGreaterThan(0, count($domains));
    }
}
