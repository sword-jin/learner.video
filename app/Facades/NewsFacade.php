<?php

namespace Learner\Facades;

use Illuminate\Support\Facades\Facade;

class NewsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'news';
    }
}
