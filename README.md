# EmailChecker

[![Build status...](https://img.shields.io/travis/MattKetmo/EmailChecker.svg?style=flat)](http://travis-ci.org/MattKetmo/EmailChecker)
[![Code quality...](https://img.shields.io/scrutinizer/g/MattKetmo/EmailChecker.svg?style=flat)](https://scrutinizer-ci.com/g/MattKetmo/EmailChecker/)
[![License MIT](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://github.com/MattKetmo/EmailChecker/blob/master/LICENSE)
[![Packagist](http://img.shields.io/packagist/v/mattketmo/email-checker.svg?style=flat)](https://packagist.org/packages/mattketmo/email-checker)

PHP library to check if an email comes from a **disposable email provider**.

To detect invalid emails, it provides a **built-in database** of
[550+ disposable email providers](res/throwaway_domains.txt),
but you can also use your own data.

*Note: this library is inspired from [FGRibreau/mailchecker](https://github.com/FGRibreau/mailchecker),
except it only focuses on PHP (and [integration with Symfony](#integration-with-symfony2)).*

## Installation

Via [Composer](http://getcomposer.org/):

```
composer require "mattketmo/email-checker:~1.0"
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

You can build your own adapter (to use another database) simply by implementing
the [AdapterInterface](src/EmailChecker/Adapter/AdapterInterface.php).

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

EmailChecker is released under the MIT License.
See the [bundled LICENSE file](LICENSE) for details.
