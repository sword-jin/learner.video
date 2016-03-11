<?php

namespace Learner\Http\Requests;

use Auth;
use Learner\Http\Requests\Request;

class UpdateProfileRequest extends Request
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
        return [
            'username' => 'required|valid_username|max:255|unique:users,username,' . Auth::id(),
            'nickname' => 'required'
        ];
    }

    /**
     * Change attributes display name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username' => '用户名',
            'nickname' => '昵称'
        ];
    }
}
