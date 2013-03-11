<?php

namespace EmailChecker;

/**
 * Some utilities for email checking.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class Utilities
{
    const EMAIL_REGEX = "#(?<local>[a-z0-9!\#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!\#$%&'*+/=?^_`{|}~-]+)*)@(?<domain>(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)#";

    /**
     * Extract parts of an email address.
     *
     * @param  string $email The email address to parse
     *
     * @return array The parts of the email. First the local part, then the domain
     */
    static public function parseEmailAddress($email)
    {
        if (!preg_match(self::EMAIL_REGEX, $email, $parts)) {
            return array(
                'local'  => '',
                'domain' => '',
            );
        }

        return array(
            'local'  => $parts['local'],
            'domain' => $parts['domain'],
        );
    }
}