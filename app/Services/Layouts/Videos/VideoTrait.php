<?php

namespace Learner\Services\Layouts\Videos;

trait VideoTrait
{
    /**
     * Set width.
     *
     * @param integer $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set height.
     *
     * @param integer $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get width.
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }
}
