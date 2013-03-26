<?php

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