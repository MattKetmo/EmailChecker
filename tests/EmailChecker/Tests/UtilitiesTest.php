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

final class UtilitiesTest extends TestCase
{
    /**
     * @dataProvider validEmails
     */
    public function testParseValidEmail(string $email, string $exceptedLocal, string $exceptedDomain): void
    {
        [$local, $domain] = Utilities::parseEmailAddress($email);

        self::assertEquals([$exceptedLocal, $exceptedDomain], [$local, $domain]);
    }

    /**
     * @dataProvider invalidEmails
     */
    public function testParseInvalidEmail(string $email): void
    {
        try {
            Utilities::parseEmailAddress($email);
            self::fail(sprintf('"%s" should not be a valid email', $email));
        } catch (InvalidEmailException $e) {
            return;
        }
    }

    public function testParseLines(): void
    {
        $content = <<<'TEXT'
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

        $message = <<<'MSG'
Failed asserting that parsed content equals expected lines.
Expected:
%s
Actual:
%s
MSG;
        self::assertEmpty($diffs, sprintf($message, print_r($expectedLines, true), print_r($parsedContent, true)));
    }

    public static function validEmails(): iterable
    {
        return [
            ['foo@bar.org', 'foo', 'bar.org'],
            ['foo@baz.org', 'foo', 'baz.org'],
        ];
    }

    public static function invalidEmails(): iterable
    {
        return [
            ['foo[at]bar.org'],
            ['foo@foo@bar.org'],
            ['foobar.org'],
        ];
    }
}
