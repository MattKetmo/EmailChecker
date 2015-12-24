<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Laravel;

use EmailChecker\EmailChecker;
use Illuminate\Support\ServiceProvider;

class EmailCheckerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the factory in the application container.
     */
    public function register()
    {
        /*
         * Register the e-mail checker
         */
        $this->app->singleton(EmailChecker::class, function ($app) {
            return new EmailChecker();
        });

        /*
         * Alias the dependency for ease.
         */
        $this->app->alias(EmailChecker::class, 'email.checker');
    }

    public function boot(EmailChecker $checker)
    {
        /*
         * Add a custom validator filter.
         */
        \Validator::extend('not_throw_away', function ($attribute, $value, $parameters, $validator) use ($checker) {
            return $checker->isValid($value);
        }, 'The :attribute domain is invalid.');
    }

    public function provides()
    {
        return ['email.checker', EmailChecker::class];
    }
}
