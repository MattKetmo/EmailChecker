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
