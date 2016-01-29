<?php

namespace Learner\Services\Forms;

class UpdateCategoryFormService extends CreateCategoryFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|max:22',
        'image' => 'image'
    ];

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'id', 'name', 'image'
        ]);
    }
}
