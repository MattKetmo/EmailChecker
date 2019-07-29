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
use EmailChecker\Adapter\AdapterInterface;
use EmailChecker\Adapter\BuiltInAdapter;
use EmailChecker\EmailChecker;

/**
 * @author Matthieu Moquet <matthieu@moquet.net>
 * @Annotation
 */
class NotThrowawayEmail extends Constraint
{
    public $message = 'The domain associated with this email is not valid.';
    public $adapter;
    private $emailChecker;

    public function __construct($options)
    {
        if (isset($options['adapter'])) {
	       	if ($options['adapter'] instanceof AdapterInterface) {
	            $this->adapter = $options['adapter'];
	        }
	        else {
	            throw new InvalidArgumentException("option 'adapter' must be instance of AdapterInterface");
	        }
	    }
	    else {
	    	$this->adapter = new BuiltInAdapter();
	    }

	    $this->emailChecker = new EmailChecker($this->adapter);

	    parent::__construct($options);
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getEmailChecker()
    {
        return $this->emailChecker;
    }
}
