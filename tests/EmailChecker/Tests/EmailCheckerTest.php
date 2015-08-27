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

use EmailChecker\EmailChecker;

class EmailCheckerTest extends TestCase
{
    public function testEmailIsValid()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $adapter->expects($this->any())
             ->method('isThrowawayDomain')
             ->will($this->returnValue(false));

        $checker = new EmailChecker($adapter);

        $this->assertTrue($checker->isValid('foo@bar.org'));
    }

    public function testEmailIsNotValid()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $adapter->expects($this->any())
             ->method('isThrowawayDomain')
             ->will($this->returnValue(true));

        $checker = new EmailChecker($adapter);

        $this->assertFalse($checker->isValid('foo@bar.org'));
    }

    public function testMalformattedEmail()
    {
        $adapter = $this->getMock('EmailChecker\Adapter\AdapterInterface');
        $checker = new EmailChecker($adapter);

        $this->assertFalse($checker->isValid('foo[at]bar.org'));
    }
}
