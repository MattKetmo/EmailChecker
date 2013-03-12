<?php

namespace EmailChecker\Tests;

use EmailChecker\EmailChecker;

class EmailCheckerTest extends TestCase
{
    public function testAdapterIsValid()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $adapter->expects($this->any())
             ->method('isThroawayDomain')
             ->will($this->returnValue(true));

        $checker = new EmailChecker($adapter);

        $this->assertTrue($checker->isValid('foo@bar.org'));
    }

    public function testAdapterIsNotValid()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $adapter->expects($this->any())
             ->method('isThroawayDomain')
             ->will($this->returnValue(false));

        $checker = new EmailChecker($adapter);

        $this->assertFalse($checker->isValid('foo@bar.org'));
    }

    public function testInvalidEmail()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $checker = new EmailChecker($adapter);

        $this->assertFalse($checker->isValid('foo[at]bar.org'));
    }
}