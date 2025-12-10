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

use EmailChecker\Adapter\AdapterInterface;
use EmailChecker\Adapter\ArrayAdapter;
use EmailChecker\EmailChecker;

final class EmailCheckerTest extends TestCase
{
    public function testEmailIsValid(): void
    {
        $adapter = new ArrayAdapter([]);
        $checker = new EmailChecker($adapter);

        self::assertTrue($checker->isValid('foo@bar.org'));
    }

    public function testEmailIsNotValid(): void
    {
        $adapter = new ArrayAdapter(['bar.org']);
        $checker = new EmailChecker($adapter);

        self::assertFalse($checker->isValid('foo@bar.org'));
    }

    public function testMalformattedEmail(): void
    {
        $adapter = new ArrayAdapter([]);
        $checker = new EmailChecker($adapter);

        self::assertFalse($checker->isValid('foo[at]bar.org'));
    }

    public function testSubDomain(): void
    {
        $adapter = new ArrayAdapter(['bar.org']);
        $checker = new EmailChecker($adapter);

        self::assertFalse($checker->isValid('foo@baz.bar.org'));
    }
}
