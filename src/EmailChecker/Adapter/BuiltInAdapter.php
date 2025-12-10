<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Adapter;

use Fgribreau\MailChecker;

/**
 * Built-in adapter.
 *
 * This adapter provides a list of throwaway domains coming from FGRibreau/mailchecker library.
 *
 * @see https://github.com/FGRibreau/mailchecker/blob/master/list.txt
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class BuiltInAdapter implements AdapterInterface
{
    public function isThrowawayDomain($domain)
    {
        // MailChecker::isBlackListed works with the whole email.
        return MailChecker::isBlacklisted('foo@'.$domain);
    }
}
