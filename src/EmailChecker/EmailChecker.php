<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker;

use EmailChecker\Adapter\AdapterInterface;
use EmailChecker\Adapter\BuiltInAdapter;
use EmailChecker\Exception\InvalidEmailException;

/**
 * Checks throwaway email.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class EmailChecker
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface $adapter Checker adapter
     */
    public function __construct(?AdapterInterface $adapter = null)
    {
        $this->adapter = $adapter ?? new BuiltInAdapter();
    }

    /**
     * Check if it's a valid email, ie. not a throwaway email.
     *
     * @param string $email The email to check
     *
     * @return bool true for a throwaway email
     */
    public function isValid($email)
    {
        if (false === $email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        try {
            [$local, $domain] = Utilities::parseEmailAddress($email);
        } catch (InvalidEmailException $e) {
            return false;
        }

        foreach ($this->allDomainSuffixes($domain) as $domainSuffix) {
            if ($this->adapter->isThrowawayDomain($domainSuffix)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return iterable<string>
     */
    private function allDomainSuffixes(string $domain): iterable
    {
        $components = explode('.', $domain);

        foreach ($components as $i => $_) {
            yield implode('.', array_slice($components, $i));
        }
    }
}
