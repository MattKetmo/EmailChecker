<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EmailChecker\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getFixtures($file)
    {
        return file_get_contents(__DIR__.'/../../fixtures/'.$file);
    }
}