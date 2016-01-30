<?php

namespace Learner\Facades;

use Illuminate\Support\Facades\Facade;

class VideoApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'video-api';
    }
}
