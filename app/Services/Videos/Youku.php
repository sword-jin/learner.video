<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoNotFoundException;

class Youku
{
    use VideoTrait;

    /**
     * Video Id
     *
     * @var String
     */
    private $id;

    /**
     * The vimeo base api url.
     *
     * @var string
     */
    private $baseUrl = 'https://openapi.youku.com/v2/videos/show_basic.json?client_id={key}&video_id={id}';

    /**
     * Get the video detail.
     *
     * @param  integer $id
     * @return array
     */
    public function getVideoDetail($id)
    {
        $this->setId($id);

        $data = $this->getData(str_replace('{key}', config('video.youku_key'), $this->baseUrl));

        if (! $data) {
            throw new VideoNotFoundException("video_not_found");
        }

        return [
            'title' => $data->title,
            'description' => $data->description,
            'duration' => intval($data->duration),
            'upload_date' => $data->published,
            'thumbnail_url' => $data->thumbnail
        ];
    }
}
