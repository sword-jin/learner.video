<?php

namespace Learner\Facades;

use Illuminate\Support\Facades\Facade;

class AvatarManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'avatar.manager';
    }
}
