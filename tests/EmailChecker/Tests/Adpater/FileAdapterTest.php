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

use EmailChecker\Adapter\FileAdapter;
use EmailChecker\Tests\TestCase;

final class FileAdapterTest extends TestCase
{
    private FileAdapter $adapter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adapter = new FileAdapter(__DIR__.'/../../../fixtures/throwaway_domains.txt');
    }

    /**
     * @dataProvider throwawayDomains
     */
    public function testThrowawayDomains(string $domain): void
    {
        $this->assertTrue($this->adapter->isThrowawayDomain($domain));
    }

    /**
     * @dataProvider notThrowawayDomains
     */
    public function testNotThrowawayDomains(string $domain): void
    {
        $this->assertFalse($this->adapter->isThrowawayDomain($domain));
    }

    public static function throwawayDomains(): iterable
    {
        return [
            ['jetable.org'],
            ['mailjet.org'],
            ['dummy-space.ext'],
            ['yopmail.com'],
        ];
    }

    public static function notThrowawayDomains(): iterable
    {
        return [
            ['gmail.com'],
            ['hotmail.com'],
            ['comment.ext'],
        ];
    }
}
