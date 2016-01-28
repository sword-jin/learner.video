<?php

namespace Learner\Services\Image;

trait ManagerTrait
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

    /**
     * Delete avatar by path.
     *
     * @param  string $path
     *
     * @return
     */
    public function delete($path)
    {
        $fullPath = $this->getFullpath($path);

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }
}
