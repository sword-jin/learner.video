<?php

use Carbon\Carbon;

/**
 * Translate to chinese.
 *
 * @param $string
 * @param $string
 *
 * @return string
 */
function lang($target, $default) {
    return Lang::has($target) ? Lang::get($target) : $default;
}

/**
 * Whether the series have video uploaded in 7 days.
 *
 * @param  string $publishd_at
 *
 * @return boolean
 */
function seriesUpdated($publishd_at)
{
    return (Carbon::now()->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s', $publishd_at))) <= 7;
}

/**
 * Active class.
 *
 * @param  string  $route
 *
 * @return boolean
 */
function isActive($route)
{
    return Request::is($route . '/*') || Request::is($route) ? 'active' : '';
}
