<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EmailChecker\Adapter;

use Gaufrette\File;

/**
 * Adapter for Gaufrette filesystem abstraction layer.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class GaufretteAdapter implements AdapterInterface
{
    protected $domains;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->domains = explode("\n", $file->getContent());
    }

    /**
     * {@ineritDoc}
     */
    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}