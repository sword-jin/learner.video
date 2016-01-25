<?php

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
