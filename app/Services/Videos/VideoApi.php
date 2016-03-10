<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoNotFoundException;

class VideoApi
{
    /**
     * Youtube
     *
     * @var Const
     */
    const YOUTUBE = 'youtube';

    /**
     * Vimeo
     *
     * @var Const
     */
    const VIMEO = 'vimeo';

    /**
     * Youku
     *
     * @var Const
     */
    const YOUKU = 'youku';

    /**
     * Set Type
     *
     * @param   string $type
     * @return  mixed
     *
     * @throws  \InvalidArgumentException
     */
    public function setType($type)
    {
        switch($type)
        {
            case self::YOUTUBE:
                return new Youtubee;
                break;

            case self::VIMEO:
                return new Vimeo;
                break;

            case self::YOUKU:
                return new Youku;
                break;

            default:
                throw new VideoNotFoundException("video_not_found");
        }
    }
}
