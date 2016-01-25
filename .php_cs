<?php

$header = <<<EOF
This file is part of the EmailChecker package.

(c) Matthieu Moquet <matthieu@moquet.net>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        'header_comment',
        'ordered_use',
        'short_array_syntax',
    ))
    ->setUsingCache(true)
    ->setUsingLinter(false)
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in([__DIR__])
            ->exclude('res')
            ->exclude('tests/bootstrap.php')
    )
;
