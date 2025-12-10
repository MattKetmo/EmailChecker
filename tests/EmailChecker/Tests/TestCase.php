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

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    protected function getFixtures(string $file): string
    {
        $content = file_get_contents(__DIR__.'/../../fixtures/'.$file);
        if (false === $content) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found', $file));
        }

        return $content;
    }
}
