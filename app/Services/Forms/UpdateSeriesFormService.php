<?php

namespace Learner\Services\Forms;

class UpdateSeriesFormService extends CreateSeriesFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title' => 'required|max:120',
        'description' => 'required',
        'image' => 'image',
        'categories' => 'required|array'
    ];

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'id', 'title', 'description', 'categories'
        ]);
    }
}
