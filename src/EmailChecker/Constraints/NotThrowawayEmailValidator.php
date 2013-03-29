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

use EmailChecker\EmailChecker;
use EmailChecker\Adapter\BuiltInAdapter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class NotThrowawayEmailValidator extends ConstraintValidator
{
    protected $emailChecker;

    /**
     * @param EmailChecker $emailChecker
     */
    public function __construct(EmailChecker $emailChecker = null)
    {
        $this->emailChecker = $emailChecker ?: new EmailChecker(new BuiltInAdapter());
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!$this->emailChecker->isValid($value)) {
            $this->context->addViolation($constraint->message);
        }
    }
}