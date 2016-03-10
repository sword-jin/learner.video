<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\VideoNotFoundException;

trait VideoTrait
{
    /**
     * Set the video id.
     *
     * @param integer $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the video data from serve.
     *
     * @param  string $url
     * @return array
     */
    private function getData($url)
    {
        $json = null;

        if(extension_loaded('curl')) {
            $ch = curl_init(str_replace('{id}', $this->id, $url));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, config('video.video_timeout'));
            $json = curl_exec($ch);
        } else {
            $json = @file_get_contents(str_replace('{id}', $this->id, $url));
        }

        if(! $json) {
            throw new VideoNotFoundException("video_not_found");
        }

        return $this->parseData($json);
    }

    /**
     * Parse the video json.
     *
     * @param  json $json
     * @return array
     */
    private function parseData($json)
    {
        $data = json_decode($json);

        if(json_last_error() === JSON_ERROR_NONE)
        {
            return $data;
        }

        throw new VideoNotFoundException("video_not_found");
    }
}
