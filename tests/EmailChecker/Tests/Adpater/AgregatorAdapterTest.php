<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

        $this->adapter = new AgregatorAdapter(array($adapter1, $adapter2));

        $this->assertFalse($this->adapter->isThrowawayDomain('example.org'));
    }

    public function testFirstInvalid()
    {
        $adapter1 = $this->getAdapterMock(true, 'once');
        $adapter2 = $this->getAdapterMock(false, 'never');

        $this->adapter = new AgregatorAdapter(array($adapter1, $adapter2));

        $this->assertTrue($this->adapter->isThrowawayDomain('example.org'));
    }

    public function testSecondInvalid()
    {
        $adapter1 = $this->getAdapterMock(false, 'once');
        $adapter2 = $this->getAdapterMock(true, 'once');

        $this->adapter = new AgregatorAdapter(array($adapter1, $adapter2));

        $this->assertTrue($this->adapter->isThrowawayDomain('example.org'));
    }

    /**
     * Build a mock of adapter interface.
     *
     * @param  boolean $isThrowawayDomain The value returned by the isThrowawayDomain method
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