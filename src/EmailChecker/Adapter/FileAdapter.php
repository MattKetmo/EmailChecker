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

        $lines = explode(PHP_EOL, file_get_contents($filename));
        $lines = array_map('trim', $lines);
        $lines = array_filter($lines, function($line) {
            return (0 === strlen($line) || '#' === $line[0]) ? false : $line;
        });

        $this->domains = $lines;
    }

    /**
     * {@ineritDoc}
     */
    public function isThrowawayDomain($domain)
    {
        return in_array($domain, $this->domains);
    }
}