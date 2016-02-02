<?php

namespace Learner\Services\Forms;

class SaveLinkFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title' => 'required|max:255',
        'link' => 'required|url',
        'type' => 'required|in:article,tutorial,video,project',
        'domain' => 'url',
        'newsletter_id' => 'required|exists:newsletters,id'
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'title' => lang('link.title', 'Link title'),
            'link' => lang('link.link', 'Link address'),
            'type' => lang('link.type', 'Link type'),
            'domain' => lang('link.domain', 'Link domain'),
            'newsletter_id' => lang('link.newsletter_id', 'Link newsletter'),
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
            'title',
            'link',
            'type',
            'domain',
            'note',
            'newsletter_id',
        ]);
    }
}
