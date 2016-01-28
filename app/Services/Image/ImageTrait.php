<?php

namespace Learner\Services\Image;

trait ImageTrait
{
    /**
     * Get
     *
     * @param  string $path
     *
     * @return string
     */
    public function getFullpath($path)
    {
        return public_path() . '/' . $path;
    }
}
