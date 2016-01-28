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
            'username' => lang('register.username', 'Username'),
            'email'    => lang('register.email', 'Email'),
            'password' => lang('register.password', 'Password'),
            'password_confirmation' => lang('register.password_confirmation', 'Password ConFirmation'),
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
            'username', 'email', 'password', 'password_confirmation',
        ]);
    }
}
