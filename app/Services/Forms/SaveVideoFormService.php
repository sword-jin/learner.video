<?php

namespace Learner\Services\Forms;

class SaveVideoFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'series_id' => 'required|exists:series,id',
        'title' => 'required|max:120',
        'resource_type' => 'required|in:vimeo,youtube,youku',
        'resource_id' => 'required',
        'published_at' => 'required|date'
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'series_id' => lang('video.create.series_id', 'Series'),
            'title' => lang('video.create.title', 'Title'),
            'resource_type' => lang('video.create.resource_type', 'Video Resource'),
            'resource_id' => lang('video.create.resource_id', 'Video Id'),
            'published_at' => lang('video.create.published_at', 'Publish Time')
        ];
    }

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'series_id',
            'title',
            'description',
            'resource_type',
            'resource_id',
            'published_at'
        ]);
    }
}
