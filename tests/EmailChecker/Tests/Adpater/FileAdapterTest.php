<?php

namespace EmailChecker\Tests\Adpater;

use EmailChecker\Adapter\FileAdapter;
use EmailChecker\Tests\TestCase;

class FileAdapterTest extends TestCase
{
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new FileAdapter(__DIR__.'/../../../fixtures/throwaway_domains.txt');
    }

    /**
     * @dataProvider throwawayDomains
     */
    public function testThrowawayDomains($domain)
    {
        $this->assertTrue($this->adapter->isThroawayDomain($domain));
    }

    /**
     * @dataProvider notThrowawayDomains
     */
    public function testNotThrowawayDomains($domain)
    {
        $this->assertFalse($this->adapter->isThroawayDomain($domain));
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