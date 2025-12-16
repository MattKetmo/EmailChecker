<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Constraints;

use EmailChecker\EmailChecker;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
final class NotThrowawayEmailValidator extends ConstraintValidator
{
    private EmailChecker $emailChecker;

    public function __construct(?EmailChecker $emailChecker = null)
    {
        $this->emailChecker = $emailChecker ?? new EmailChecker();
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof NotThrowawayEmail) {
            throw new UnexpectedTypeException($constraint, NotThrowawayEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!$this->emailChecker->isValid((string) $value)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
