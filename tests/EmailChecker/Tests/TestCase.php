<?php

namespace EmailChecker\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getFixtures($file)
    {
        return file_get_contents(__DIR__.'/../../fixtures/'.$file);
    }
}