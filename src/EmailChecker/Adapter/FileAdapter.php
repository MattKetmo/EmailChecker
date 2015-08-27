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

/**
 * Throwaway email adapter build with file.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class FileAdapter implements AdapterInterface
{
    protected $domains;

    /**
     * @param string $filename Filename containing all domains
     */
    public function __construct($filename)
    {
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found', $filename));
        }

        $this->domains = Utilities::parseLines(file_get_contents($filename));
    }

    /**
     * {@inheritdoc}
     */
    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}
