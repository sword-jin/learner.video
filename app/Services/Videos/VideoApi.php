<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoNotValidException;


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

            default:
                throw new VideoNotValidException("$type is not a valid video site");
        }
    }
}
