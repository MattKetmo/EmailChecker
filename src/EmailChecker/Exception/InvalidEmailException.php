<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
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
