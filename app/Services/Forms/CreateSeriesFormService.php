<?php

namespace Learner\Services\Forms;

class CreateSeriesFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title' => 'required|max:120',
        'description' => 'required',
        'image' => 'required|image',
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'title' => lang('series.create.title', 'Title'),
            'description' => lang('series.create.description', 'Description'),
            'image' => lang('series.create.image', 'Image')
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
            'title', 'description', 'image'
        ]);
    }
}
