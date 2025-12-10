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

use Symfony\Component\Validator\Constraint;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 *
 * @Annotation
 */
#[\Attribute]
class NotThrowawayEmail extends Constraint
{
    /**
     * @var string
     */
    public $message = 'The domain associated with this email is not valid.';

    public function __construct(
        array|string|null $message = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        $options = [];
        if (\is_array($message)) {
            $options = $message;
            $message = $options['message'] ?? null;
        }

        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}
