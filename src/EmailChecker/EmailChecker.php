<?php

namespace EmailChecker;

use EmailChecker\Adapter\AdapterInterface;

/**
 * Checks throwaway email.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class EmailChecker
{
    protected $adapter;

    /**
     * @param AdapterInterface $adapter Checker adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Check if it's a valid email, ie. not a throwaway email.
     *
     * @param  string  $email The email to check
     *
     * @return boolean true for a throwaway email
     */
    public function isValid($email)
    {
        if (false === $email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        list($local, $domain) = Utilities::parseEmailAddress($email);

        return $this->adapter->isDomainThrowable($domain);
    }
}