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
        'slug' => 'required|max:200|unique:series',
        'description' => 'required',
        'image' => 'required|image',
        'categories' => 'required|array'
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
            'slug' => 'Slug',
            'image' => lang('series.create.image', 'Image'),
            'categories' => lang('series.create.category', 'Category')
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
            'title', 'slug', 'description', 'image', 'categories'
        ]);
    }
}
