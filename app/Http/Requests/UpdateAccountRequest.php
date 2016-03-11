<?php

namespace Learner\Http\Requests;

use Learner\Http\Requests\Request;

class UpdateAccountRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->get('currentPassword') !== null) {
            return [
                'currentPassword' => 'required|passcheck',
                'password' => 'required|confirmed|min:6',
            ];
        } else {
            return [
                'password' => 'required|confirmed|min:6',
            ];
        }
    }

    /**
     * Change attributes display name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'currentPassword' => '当前密码',
            'password' => '新密码'
        ];
    }
}
