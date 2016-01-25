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

use EmailChecker\Adapter\AgregatorAdapter;
use EmailChecker\Tests\TestCase;

class AgregatorAdapterTest extends TestCase
{
    public function testAllValid()
    {
        $adapter1 = $this->getAdapterMock(false, 'once');
        $adapter2 = $this->getAdapterMock(false, 'once');

        $this->adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertFalse($this->adapter->isThrowawayDomain('example.org'));
    }

    public function testFirstInvalid()
    {
        $adapter1 = $this->getAdapterMock(true, 'once');
        $adapter2 = $this->getAdapterMock(false, 'never');

        $this->adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertTrue($this->adapter->isThrowawayDomain('example.org'));
    }

    public function testSecondInvalid()
    {
        $adapter1 = $this->getAdapterMock(false, 'once');
        $adapter2 = $this->getAdapterMock(true, 'once');

        $this->adapter = new AgregatorAdapter([$adapter1, $adapter2]);

        $this->assertTrue($this->adapter->isThrowawayDomain('example.org'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCheckArrayValuesInstanceOf()
    {
        new AgregatorAdapter([
            new \stdClass(),
            new \stdClass(),
        ]);
    }

    /**
     * Build a mock of adapter interface.
     *
     * @param bool $isThrowawayDomain The value returned by the isThrowawayDomain method
     *
     * @return AdapterInterface The mock adapter
     */
    protected function getAdapterMock($isThrowawayDomain, $call = 'any')
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $adapter->expects($this->$call())
            ->method('isThrowawayDomain')
            ->will($this->returnValue($isThrowawayDomain));

        return $adapter;
    }
}
