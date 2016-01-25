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

        $this->assertEquals([$exceptedLocal, $exceptedDomain], [$local, $domain]);
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

    public function testParseLines()
    {
        $content = <<<TEXT
# This is a comment and should be parsed
Uppercase
foo
   bar
#baz
TEXT;

        $parsedContent = Utilities::parseLines($content);
        $expectedLines = [
            'uppercase',
            'foo',
            'bar',
        ];

        $diffs = array_diff($expectedLines, $parsedContent);

        $message = <<<MSG
Failed asserting that parsed content equals expected lines.
Expected:
%s
Actual:
%s
MSG;
        $this->assertEmpty($diffs, sprintf($message, print_r($expectedLines, true), print_r($parsedContent, true)));
    }

    public static function validEmails()
    {
        return [
            ['foo@bar.org', 'foo', 'bar.org'],
            ['foo@baz.org', 'foo', 'baz.org'],
        ];
    }

    public static function invalidEmails()
    {
        return [
            ['foo[at]bar.org'],
            ['foo@foo@bar.org'],
            ['foobar.org'],
        ];
    }
}
