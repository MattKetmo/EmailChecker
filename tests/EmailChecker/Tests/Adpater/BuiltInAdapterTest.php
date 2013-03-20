<?php

namespace EmailChecker\Tests\Adpater;

use EmailChecker\Adapter\BuiltInAdapter;
use EmailChecker\Tests\TestCase;

class BuiltInAdapterTest extends TestCase
{
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new BuiltInAdapter();
    }

    /**
     * @dataProvider throwawayDomains
     */
    public function testThrowawayDomains($domain)
    {
        $this->assertTrue($this->adapter->isThrowawayDomain($domain));
    }

    public static function throwawayDomains()
    {
        // List of some of the built-in throwaway domains
        return array(
            array('throwawayemailaddress.com'),
            array('tmail.com'),
            array('tmailinator.com'),
            array('tradermail.info'),
            array('trash-amil.com'),
            array('trash-mail.com'),
            array('trash-mail.de'),
            array('trash2009.com'),
            array('trashemail.de'),
            array('trashmail.at'),
            array('trashmail.com'),
            array('trashmail.net'),
            array('trashmail.ws'),
            array('trashmailer.com'),
            array('trashymail.com'),
            array('trashymail.net'),
            array('trillianpro.com'),
            array('turual.com'),
            array('tyldd.com'),
            array('uggsrock.com'),
            array('upliftnow.com'),
            array('uplipht.com'),
            array('veryrealemail.com'),
            array('viditag.com'),
            array('viewcastmedia.com'),
            array('viewcastmedia.net'),
            array('viewcastmedia.org'),
            array('webm4il.info'),
            array('wegwerfemail.de'),
            array('wetrainbayarea.com'),
            array('wetrainbayarea.org'),
            array('wh4f.org'),
            array('whyspam.me'),
            array('willselfdestruct.com'),
            array('wuzup.net'),
            array('wuzupmail.net'),
            array('xagloo.co'),
            array('xemaps.com'),
            array('xmail.com'),
            array('yopmail.com'),
        );
    }
}