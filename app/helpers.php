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
function isNew($publishd_at)
{
    return (Carbon::now()->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s', $publishd_at))) <= 7;
}

/**
 * Navigation Active class.
 *
 * @param  string  $route
 *
 * @return string
 */
function isActive($route)
{
    return Request::is($route . '/*') || Request::is($route) ? 'active' : '';
}

/**
 * Category list active class.
 *
 * @param  string $name
 *
 * @return string
 */
function categoryIsActive($name)
{
    return route('categories', $name) == URL::current() ||
        route('categories', $name) == URL::current() . '#*' ? ' active' : ':';
}

/**
 * Format date to read.
 *
 * @param  string $date
 *
 * @return string
 */
function dateHuman($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
}

/**
 * Format time to date.
 *
 * @param  string $date
 *
 * @return string
 */
function timeToDate($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
}

/**
 * Format the video duration.
 *
 * @param  integer $duration
 *
 * @return string
 */
function secondForHuman($duration) {
    if ($duration < 10) {
        return '00:0' . $duration;
    } else if ($duration < 60) {
        return '00:' . $duration;
    } else if ($duration == 60) {
        return '01:00';
    } else if ($duration < 3600) {
        $minutes = floor($duration / 60);
        $seconds = $duration - $minutes * 60;

        if ($minutes < 10) $minutes = '0' . $minutes;
        if ($seconds < 10) $seconds = '0' . $seconds;

        return $minutes . ':' . $seconds;
    } else {
        $hours = floor($duration / 3600);
        $minutes = floor(($duration - $hours * 3600) / 60);
        $seconds = $duration - $hours * 3600 - $minutes * 60;

        if ($minutes < 10) $minutes = '0' . $minutes;
        if ($seconds < 10) $seconds = '0' . $seconds;
        if ($hours < 10) $hours = '0' + $hours;

        return $hours . ':' . $minutes . ':' . $seconds;
    }
}
