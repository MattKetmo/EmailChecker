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

use EmailChecker\Adapter\ArrayAdapter;
use EmailChecker\Tests\TestCase;

final class ArrayAdapterTest extends TestCase
{
    private const DOMAINS = [
        'jetable.org',
        'mailjet.org',
    ];

    private ArrayAdapter $adapter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adapter = new ArrayAdapter(self::DOMAINS);
    }

    /**
     * @dataProvider throwawayDomains
     */
    public function testThrowawayDomains(string $domain): void
    {
        self::assertTrue($this->adapter->isThrowawayDomain($domain));
    }

    /**
     * @dataProvider notThrowawayDomains
     */
    public function testNotThrowawayDomains(string $domain): void
    {
        self::assertFalse($this->adapter->isThrowawayDomain($domain));
    }

    public static function throwawayDomains(): iterable
    {
        return [
            ['jetable.org'],
            ['mailjet.org'],
        ];
    }

    public static function notThrowawayDomains(): iterable
    {
        return [
            ['gmail.com'],
            ['hotmail.com'],
        ];
    }
}
