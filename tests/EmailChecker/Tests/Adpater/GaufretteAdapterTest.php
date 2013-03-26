<?php

namespace EmailChecker\Tests\Adpater;

use EmailChecker\Adapter\GaufretteAdapter;
use EmailChecker\Tests\TestCase;
use Gaufrette\Adapter\Local as LocalAdapter;
use Gaufrette\File;
use Gaufrette\Filesystem;

class GaufretteAdapterTest extends TestCase
{
    protected $adapter;

    public function setUp()
    {
        $filesystem = new Filesystem(new LocalAdapter(__DIR__.'/../../../fixtures'));
        $file       = new File('throwaway_domains.txt', $filesystem);

        $this->adapter = new GaufretteAdapter($file);
    }

    /**
     * @dataProvider throwawayDomains
     */
    public function testThrowawayDomains($domain)
    {
        $this->assertTrue($this->adapter->isThrowawayDomain($domain));
    }

    /**
     * @dataProvider notThrowawayDomains
     */
    public function testNotThrowawayDomains($domain)
    {
        $this->assertFalse($this->adapter->isThrowawayDomain($domain));
    }

    public static function throwawayDomains()
    {
        return array(
            array('jetable.org'),
            array('mailjet.org'),
        );
    }

    public static function notThrowawayDomains()
    {
        return array(
            array('gmail.com'),
            array('hotmail.com'),
        );
    }
}