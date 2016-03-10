<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoNotFoundException;

class Youtubee
{
    use VideoTrait;

    /**
     * Video Id
     *
     * @var string
     */
    private $id;

    /**
     * The vimeo base api url.
     *
     * @var string
     */
    private $baseUrl = 'https://www.googleapis.com/youtube/v3/videos?id={id}&key={key}&part=snippet,contentDetails,statistics';

    /**
     * Get the video detail.
     *
     * @param  integer $id
     * @return array
     */
    public function getVideoDetail($id)
    {
        $this->setId($id);

        $data = $this->getData(str_replace('{key}', config('video.youtube_key'), $this->baseUrl));

        if (! $data) {
            throw new VideoNotFoundException("video_not_found");
        }

        return [
            'title' => $data->items[0]->snippet->title,
            'description' => $data->items[0]->snippet->description,
            'duration' => $this->formatDuration($data->items[0]->contentDetails->duration),
            'upload_date' => $data->items[0]->snippet->publishedAt,
            'thumbnail_url' => $data->items[0]->snippet->thumbnails->high->url,
        ];
    }

    /**
     * Format the duration.
     *
     * @param  string $duration
     * @return integer
     */
    private function formatDuration($duration)
    {
        preg_match_all("/PT(\d+H)?(\d+M)?(\d+S)?/", $duration, $matches);

        $hours   = strlen($matches[1][0]) == 0 ? 0 : substr($matches[1][0], 0, strlen($matches[1][0]) - 1);
        $minutes = strlen($matches[2][0]) == 0 ? 0 : substr($matches[2][0], 0, strlen($matches[2][0]) - 1);
        $seconds = strlen($matches[3][0]) == 0 ? 0 : substr($matches[3][0], 0, strlen($matches[3][0]) - 1);

        return 3600 * $hours + 60 * $minutes + $seconds;
    }
}
