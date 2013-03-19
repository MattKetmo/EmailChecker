<?php

namespace EmailChecker\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class NotThrowawayEmail extends Constraint
{
    public $message = 'The domain associated with this email is not valid.';
}