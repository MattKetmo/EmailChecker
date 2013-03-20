<?php

namespace EmailChecker\Tests\Adpater;

use EmailChecker\Adapter\ArrayAdapter;
use EmailChecker\Tests\TestCase;

class ArrayAdapterTest extends TestCase
{
    protected static $throawayDomains = array(
        'jetable.org',
        'mailjet.org',
    );

    protected $adapter;

    public function setUp()
    {
        $this->adapter = new ArrayAdapter(self::$throawayDomains);
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