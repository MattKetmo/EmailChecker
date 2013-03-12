<?php

namespace EmailChecker\Adapter;

/**
 * Built-in adapter.
 *
 * This adapter provides a list of throwaway domains included in that library.
 * Initially, those domains come from FGRibreau/mailchecker library.
 *
 * @see https://github.com/FGRibreau/mailchecker/blob/master/list.json
 *
 * @author Matthieu Moquet <matthieu@moquet.net>
 */
class BuiltInAdapter extends FileAdapter
{
    protected $domains;

    public function __construct()
    {
        parent::__construct(__DIR__.'/../../../res/throwaway_domains.txt');
    }
}