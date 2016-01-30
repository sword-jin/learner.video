<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoTypeNotValidException;

class Video
{
    /**
     * Vimeo
     *
     * @var Const
     */
    const VIMEO = 'vimeo';

    /**
     * Youtube
     *
     * @var Const
     */
    const YOUTUBE = 'youtube';

    public function setType($type)
    {
        switch($type) {
            case self::VIMEO:
                return new Vimeo;
                break;

            case self::YOUTUBE:
                return new Youtube;
                break;

            default:
                throw new VideoTypeNotValidException($type . "not exists in this app.");
        }
    }
}
