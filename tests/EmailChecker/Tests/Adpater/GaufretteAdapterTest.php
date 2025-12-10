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

use EmailChecker\Adapter\GaufretteAdapter;
use EmailChecker\Tests\TestCase;
use Gaufrette\Adapter\Local as LocalAdapter;
use Gaufrette\File;
use Gaufrette\Filesystem;

final class GaufretteAdapterTest extends TestCase
{
    private GaufretteAdapter $adapter;

    protected function setUp(): void
    {
        parent::setUp();

        $filesystem = new Filesystem(new LocalAdapter(__DIR__.'/../../../fixtures'));
        $file = new File('throwaway_domains.txt', $filesystem);

        $this->adapter = new GaufretteAdapter($file);
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
