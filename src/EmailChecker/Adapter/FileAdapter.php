<?php

namespace EmailChecker\Adapter;

/**
 * Throwaway email adapter build with file.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class FileAdapter implements AdapterInterface
{
    protected $domains;

    /**
     * @param array $domains List of throwaway domains
     */
    public function __construct($filename)
    {
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found', $filename));
        }

        $this->domains = explode("\n", file_get_contents($filename));
    }

    /**
     * {@ineritDoc}
     */
    public function isThroawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}