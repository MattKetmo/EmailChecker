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
use Illuminate\Support\Facades\Validator;

/**
 * Laravel service provider.
 *
 * @author Oliver Green <dubious@codeblog.co.uk>
 */
class EmailCheckerServiceProvider extends ServiceProvider
{
    protected $app;

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

    /**
     * Bootstrap any application services.
     */
    public function boot(EmailChecker $checker)
    {
        /*
         * Add a custom validator filter.
         */
        $check = function ($attr, $value, $param, $validator) use ($checker) {
            return $checker->isValid($value);
        };

        Validator::extend(
            'not_throw_away', $check, 'The :attribute domain is invalid.'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['email.checker', EmailChecker::class];
    }
}
