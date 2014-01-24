<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EmailChecker\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 * @Annotation
 */
class NotThrowawayEmail extends Constraint
{
    public $message = 'The domain associated with this email is not valid.';
}
