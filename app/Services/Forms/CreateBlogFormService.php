<?php

namespace Learner\Services\Forms;

class CreateBlogFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|max:128',
        'body' => 'required'
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'category_id' => lang('blog.category_id', 'Blog category'),
            'title' => lang('blog.title', 'Blog title'),
            'body' => lang('blog.body', 'Blog content')
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
            'category_id',
            'title',
            'body',
            'is_published',
            'created_at'
        ]);
    }
}
