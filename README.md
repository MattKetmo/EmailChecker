# EmailChecker

[![Build Status](https://secure.travis-ci.org/MattKetmo/EmailChecker.png)](http://travis-ci.org/MattKetmo/EmailChecker)

PHP library to check if an email comes from a **disposable email provider**.

Note: this library is inspired from [FGRibreau/mailchecker](https://github.com/FGRibreau/mailchecker),
except it only focuses on PHP.

## Installation

Via [Composer](http://getcomposer.org/):

```
composer require "mattketmo/email-checker:dev-master"
```

## Usage

Basic use of EmailChecker with built-in throwaway email list:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use EmailChecker\EmailChecker;

$checker = new EmailChecker();

$checker->isValid('foo@bar.org');     // true
$checker->isValid('foo@yopmail.com'); // false
```

Or using another adapter:

```php
<?php

use EmailChecker\EmailChecker;
use EmailChecker\Adapter;

$checker = new EmailChecker(new Adapter\ArrayAdapter(array(
    'foo.org',
    'baz.net'
)));

$checker->isValid('foo@bar.org'); // true
$checker->isValid('foo@baz.net'); // false
```

## Integration with Symfony2

This library also provides a constraint validation for your Symfony2 project:

```php

use EmailChecker\Constraints as EmailCheckerAssert;
use Symfony\Component\Validator\Constraints as Assert;

class User
{
    /**
     * @Assert\NotBlank
     * @EmailCheckerAssert\NotThrowawayEmail
     */
    protected $email;
}
```

## License

EmailChecker is licensed under the MIT License — see the LICENSE file for details
