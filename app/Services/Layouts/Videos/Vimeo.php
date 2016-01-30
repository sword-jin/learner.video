<?php

namespace Learner\Services\Layouts\Videos;

class Vimeo
{
    /**
     * Id
     *
     * @var integer
     */
    private $id;

    /**
     * Width
     *
     * @var integer
     */
    private $width = 1280;

    /**
     * Height
     *
     * @var integer
     */
    private $height = 720;

    /**
     * Get the iframe code.
     *
     * @param  integer $id
     *
     * @return string
     */
    public function getIFrame($id)
    {
        return '<iframe src="https://player.vimeo.com/video/' . $id . '"width="' . $this->getWidth() . '" height="' . $this->getHeight() . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

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
