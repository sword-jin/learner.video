<?php

namespace Learner\Services\Videos;

use Learner\Exceptions\JsonNotValidException;
use Learner\Exceptions\VideoNotFoundException;

class Vimeo
{
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
    private $baseUrl = 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/';

    public function getVideoDetail($id)
    {
        $this->setId($id);

        $data = $this->getData($this->baseUrl . '' . $this->id);

        if (! $data) {
            throw new VideoNotFoundException("Video not found.");
        }

        return [
            'html' => $data->html,
            'title' => $data->title,
            'duration' => $data->duration,
            'author_url' => $data->author_url,
            'upload_date' => $data->upload_date,
            'author_name' => $data->author_name,
            'thumbnail_url' => $data->thumbnail_url
        ];
    }

    private function setId($id)
    {
        $this->id = $id;
    }

    private function getData($url)
    {
        $json = null;

        if(extension_loaded('curl')) {
            $ch = curl_init(str_replace('{id}', $this->id, $url));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
        } else {
            $json = @file_get_contents(str_replace('{id}', $this->id, $url));
        }

        if(! $json) {
            throw new VideoNotFoundException("Video id is not found");
        }

        return $this->parseData($json);
    }

    private function parseData($json)
    {
        $data = json_decode($json);

        if(json_last_error() === JSON_ERROR_NONE)
        {
            return $data;
        }

        throw new JsonNotValidException("Video id is not found. (Invalid json)");
    }
}
