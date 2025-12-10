<?php

$header = <<<EOF
This file is part of the EmailChecker package.

(c) Matthieu Moquet <matthieu@moquet.net>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->in(__DIR__)
    ->exclude('res')
    ->exclude('tests/bootstrap.php')
    ->exclude('vendor')
    ->name('*.php');

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'header_comment' => [
            'header' => $header,
        ]
    ])
    ->setFinder($finder);
