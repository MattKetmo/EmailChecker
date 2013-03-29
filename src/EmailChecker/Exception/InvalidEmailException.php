<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EmailChecker\Exception;

/**
 * Exception when the given email is not valid.
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class InvalidEmailException extends \InvalidArgumentException
{
}