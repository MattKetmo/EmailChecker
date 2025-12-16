<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Tests\Adapter;

use EmailChecker\Adapter\AdapterInterface;
use EmailChecker\Adapter\AggregatorAdapter;
use EmailChecker\Tests\TestCase;

final class AggregatorAdapterTest extends TestCase
{
    public function testAllValid(): void
    {
        $adapter1 = $this->getAdapterMock(false);
        $adapter2 = $this->getAdapterMock(false);

        $adapter = new AggregatorAdapter([$adapter1, $adapter2]);

        self::assertFalse($adapter->isThrowawayDomain('example.org'));
    }

    public function testFirstInvalid(): void
    {
        $adapter1 = $this->getAdapterMock(true);
        $adapter2 = $this->getAdapterMock(false);

        $adapter = new AggregatorAdapter([$adapter1, $adapter2]);

        self::assertTrue($adapter->isThrowawayDomain('example.org'));
    }

    public function testSecondInvalid(): void
    {
        $adapter1 = $this->getAdapterMock(false);
        $adapter2 = $this->getAdapterMock(true);

        $adapter = new AggregatorAdapter([$adapter1, $adapter2]);

        self::assertTrue($adapter->isThrowawayDomain('example.org'));
    }

    /**
     * Build a mock of adapter interface.
     *
     * @param bool $isThrowawayDomain The value returned by the isThrowawayDomain method
     *
     * @return AdapterInterface The mock adapter
     */
    private function getAdapterMock(bool $isThrowawayDomain): AdapterInterface
    {
        $adapter = $this->createStub(AdapterInterface::class);
        $adapter
            ->method('isThrowawayDomain')
            ->willReturn($isThrowawayDomain);

        return $adapter;
    }
}
