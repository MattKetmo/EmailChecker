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

use EmailChecker\Exception\InvalidEmailException;

/**
 * Some utilities for email checking.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class Utilities
{
    const EMAIL_REGEX_LOCAL = '(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*';
    const EMAIL_REGEX_DOMAIN = '(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))';

    /**
     * Extract parts of an email address.
     *
     * @param string $email The email address to parse
     *
     * @return array The parts of the email. First the local part, then the domain
     */
    public static function parseEmailAddress($email)
    {
        $pattern = sprintf('/^(?<local>%s)@(?<domain>%s)$/iD', self::EMAIL_REGEX_LOCAL, self::EMAIL_REGEX_DOMAIN);

        if (!preg_match($pattern, $email, $parts)) {
            throw new InvalidEmailException(sprintf('"%s" is not a valid email', $email));
        }

        return array_map('strtolower', [$parts['local'], $parts['domain']]);
    }

    /**
     * Parse content and extract lines.
     *
     * @param string $content The content to parse
     *
     * @return array Array of cleaned string
     */
    public static function parseLines($content)
    {
        // Split by line
        $lines = explode("\n", $content);

        // Trim and convert to lowercase
        $lines = array_map('trim', $lines);
        $lines = array_map('strtolower', $lines);

        // Remove empty lines and comments
        $lines = array_filter($lines, function ($line) {
            return (0 === strlen($line) || '#' === $line[0]) ? false : $line;
        });

        return $lines;
    }
}
