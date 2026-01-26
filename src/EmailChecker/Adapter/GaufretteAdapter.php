<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Adapter;

use EmailChecker\Utilities;
use Gaufrette\File;

/**
 * Adapter for Gaufrette filesystem abstraction layer.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
final class GaufretteAdapter extends ArrayAdapter
{
    public function __construct(File $file)
    {
        parent::__construct(Utilities::parseLines($file->getContent()));
    }
}
