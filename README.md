# EmailChecker

[![Build status...](https://img.shields.io/travis/MattKetmo/EmailChecker.svg)](http://travis-ci.org/MattKetmo/EmailChecker)
[![Code quality...](https://img.shields.io/scrutinizer/g/MattKetmo/EmailChecker.svg)](https://scrutinizer-ci.com/g/MattKetmo/EmailChecker/)
[![Downloads](https://img.shields.io/packagist/dt/mattketmo/email-checker.svg)](https://packagist.org/packages/mattketmo/email-checker)
[![Packagist](http://img.shields.io/packagist/v/mattketmo/email-checker.svg)](https://packagist.org/packages/mattketmo/email-checker)
[![License MIT](http://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/MattKetmo/EmailChecker/blob/master/LICENSE)

PHP library to check if an email comes from a **disposable email provider**.

To detect invalid emails, it provides a **built-in database** of
[1000+ disposable email providers](res/throwaway_domains.txt),
but you can also use your own data.

## Installation

Via [Composer](http://getcomposer.org/):

```
composer require mattketmo/email-checker
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

Or using a custom adapter:

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
<?php

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

## Integration with Laravel 5

To integrate this library with your Laravel 5.x project add the following
line to the `providers` key within your `config/app.php` file:

```php
EmailChecker\Laravel\EmailCheckerServiceProvider::class
```

If you would like to use the `EmailChecker` facade, you must also add the
following line to the `aliases` key within your `config/app.php` file:

```php
'EmailChecker' => EmailChecker\Laravel\EmailCheckerFacade::class
```

You can then use the library within your project like so:

```php
<?php

class MyClass
{
	public function foo()
	{
        // Facade Access
        EmailChecker::isValid('address@domain.com');

        // Container Access
        $checker = app()->make('email.checker');
        $checker->isValid('address@domain.com');
    }

    public function getValidator(array $data)
    {
        // Not thow away validator
        return Validator::make($data, [
    	     'email' => 'required|email|not_throw_away'
    	]);
    }
}
```

## List of some disposable emails database

- http://10minutemail.com
- http://spamdecoy.net
- http://torvpn.com/temporaryemail.html
- http://www.bloggingwv.com/big-list-of-disposable-temporary-email-services/
- http://www.fakemailgenerator.com/
- http://www.warriorforum.com/main-internet-marketing-discussion-forum/147524-list-temporary-email-services-you-may-want-block-your-autoresponder-little-rant.html
- http://xenforo.com/community/threads/ban-temporary-email-addresses.5461/

## License

EmailChecker is released under the MIT License.
See the [bundled LICENSE file](LICENSE) for details.
