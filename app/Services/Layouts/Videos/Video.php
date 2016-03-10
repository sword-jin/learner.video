<?php

namespace Learner\Services\Layouts\Videos;

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

    /**
     * Youku
     *
     * @var Const
     */
    const YOUKU = 'youku';

    public function setType($type)
    {
        switch($type) {
            case self::VIMEO:
                return new Vimeo;
                break;

            case self::YOUTUBE:
                return new Youtube;
                break;

            case self::YOUKU:
                return new Youku;
                break;

            default:
                throw new VideoTypeNotValidException($type . "not exists in this app.");
        }
    }
}
