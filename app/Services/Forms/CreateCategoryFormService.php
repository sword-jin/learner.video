<?php

namespace Learner\Services\Forms;

class CreateCategoryFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|max:22|unique:categories',
        'image' => 'required|image'
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'name' => lang('category.create.name', 'Name'),
            'image' => lang('category.create.image', 'Image')
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
            'name', 'image'
        ]);
    }
}
