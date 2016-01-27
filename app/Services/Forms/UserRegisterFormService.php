<?php

namespace Learner\Services\Forms;

class UserRegisterFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required|valid_username|alpha_dash|max:255|unique:users',
        'email'    => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
    ];

    /**
     * Custom user attributes aliases.
     *
     * @return array
     */
    public function getAttributes()
    {
        return [
            'username' => trans('register.username'),
            'email'    => trans('register.email'),
            'password' => trans('register.password'),
            'password_confirmation' => trans('register.password_confirmation'),
        ];
    }

    public function getInputData()
    {
        return array_only($this->inputData, [
            'username', 'email', 'password', 'password_confirmation',
        ]);
    }
}
