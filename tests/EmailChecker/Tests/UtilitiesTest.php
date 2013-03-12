<?php

namespace EmailChecker\Tests;

use EmailChecker\Exception\InvalidEmailException;
use EmailChecker\Utilities;

class UtilitiesTest extends TestCase
{
    /**
     * @dataProvider validEmails
     */
    public function testParseValidEmail($email, $exceptedLocal, $exceptedDomain)
    {
        list($local, $domain) = Utilities::parseEmailAddress($email);

        $this->assertEquals(array($exceptedLocal, $exceptedDomain), array($local, $domain));
    }

    /**
     * @dataProvider invalidEmails
     */
    public function testParseInvalidEmail($email)
    {
        try {
            Utilities::parseEmailAddress($email);
            $this->fail(sprintf('"%s" should not be a valid email', $email));
        } catch (InvalidEmailException $e) {
            return;
        }
    }

    public static function validEmails()
    {
        return array(
            array('foo@bar.org', 'foo', 'bar.org'),
            array('foo@baz.org', 'foo', 'baz.org'),
        );
    }

    public static function invalidEmails()
    {
        return array(
            array('foo[at]bar.org'),
        );
    }
}