<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Tests\Adpater;

use EmailChecker\Adapter\AdapterInterface;
use EmailChecker\Adapter\AgregatorAdapter;
use EmailChecker\Tests\TestCase;

final class AgregatorAdapterTest extends TestCase
{
    public function testAllValid(): void
    {
        $adapter1 = $this->getAdapterMock(false, 'once');
        $adapter2 = $this->getAdapterMock(false, 'once');

        $adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertFalse($adapter->isThrowawayDomain('example.org'));
    }

    public function testFirstInvalid(): void
    {
        $adapter1 = $this->getAdapterMock(true, 'once');
        $adapter2 = $this->getAdapterMock(false, 'never');

        $adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertTrue($adapter->isThrowawayDomain('example.org'));
    }

    public function testSecondInvalid(): void
    {
        $adapter1 = $this->getAdapterMock(false, 'once');
        $adapter2 = $this->getAdapterMock(true, 'once');

        $adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertTrue($adapter->isThrowawayDomain('example.org'));
    }

    /**
     * Build a mock of adapter interface.
     *
     * @param bool $isThrowawayDomain The value returned by the isThrowawayDomain method
     *
     * @return AdapterInterface The mock adapter
     */
    protected function getAdapterMock(bool $isThrowawayDomain, string $call = 'any'): AdapterInterface
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->$call())
            ->method('isThrowawayDomain')
            ->will($this->returnValue($isThrowawayDomain));

        return $adapter;
    }
}
