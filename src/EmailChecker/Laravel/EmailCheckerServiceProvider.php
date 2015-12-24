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
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the e-mail checker
         */
        $this->app->singleton(EmailChecker::class, function($app) {
            return new EmailChecker();
        });

        /*
         * Alias the dependency for ease.
         */
        $this->app->alias(EmailChecker::class, 'mail.checker');
    }

    public function boot(EmailChecker $checker)
    {
        //
    }


    public function provides()
    {
        return ['mail.checker', EmailChecker::class];
    }
}
