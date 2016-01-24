<?php

namespace Learner\Services\Forms;

class UserFormService extends AbstractFormService
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required|valid_username|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users',
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
            'username' => '用户名',
            'email'    => '邮箱',
            'password' => '密码',
            'password_confirmation' => '确认密码',
        ];
    }

    public function getInputData()
    {
        return array_only($this->inputData, [
            'username', 'email', 'password', 'password_confirmation',
        ]);
    }
}