<?php

namespace Learner\Services\Layouts\Videos;

use Exception;

class Youtube
{
    use VideoTrait;

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
        return '<iframe width="' . $this->getWidth() . '" height="' . $this->getHeight() . '"' . ' src="https://www.youtube.com/embed/' . $id . '" ' . 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }
}
