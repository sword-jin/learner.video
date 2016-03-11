<?php

namespace Learner\Http\Controllers;

use Hash;
use Auth;
use Learner\Http\Controllers\BaseController;
use Learner\Http\Requests\UpdateAccountRequest;
use Learner\Http\Requests\UpdateProfileRequest;

class UserController extends BaseController
{
    /**
     * User must login to get own home.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Personal profile page.
     *
     * /user/profile get
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.profile')
            ->withUser(Auth::user());
    }

    /**
     * Personal home page.
     *
     * /user/account get
     *
     * @return \Illuminate\View\View
     */
    public function account()
    {
        return view('user.account')
            ->withUser(Auth::user());
    }

    /**
     * Update user profile.
     *
     * /user/profile post
     *
     * @return \Illuminate\View\View
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->all());

        flashy()->mutedDark("修改资料成功");

        return $this->redirectBack();
    }

    /**
     * Update user account.
     *
     * /user/account post
     *
     * @return \Illuminate\View\View
     */
    public function updateAccount(UpdateAccountRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        flashy()->success('密码修改成功, 请重新登陆');
        Auth::logout();

        return $this->redirectToRoute('auth.login');
    }
}
