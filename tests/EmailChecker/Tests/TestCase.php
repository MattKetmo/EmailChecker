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

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getFixtures($file)
    {
        return file_get_contents(__DIR__.'/../../fixtures/'.$file);
    }
}
