<?php

namespace Learner\Services\Forms;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

abstract class AbstractFormService
{
    /**
     * The input data of the current request.
     *
     * @var array
     */
    protected $inputData = [];

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Array of custom validation messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * The Model's attributes aliases.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * AbstractForm constructor.
     */
    public function __construct()
    {
        $this->inputData = App::make('request')->all();
    }

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return $this->inputData;
    }

    /**
     * Check whether the input data is valid.
     *
     * @return boolean
     */
    public function isValid()
    {
        $this->validator = Validator::make(
            $this->getInputData(),
            $this->getRules(),
            $this->getMessages(),
            $this->getAttributes()
        );

        return $this->validator->passes();
    }

    /**
     * Get the validation errors off of the Validator instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }

    /**
     * Get the prepared validation rules.
     *
     * @return array
     */
    protected function getRules()
    {
        return $this->rules;
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    protected function getMessages()
    {
        return $this->messages;
    }

    /**
     * Get the custom attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}