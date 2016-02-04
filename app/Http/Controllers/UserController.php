<?php

namespace Learner\Http\Controllers;

use Auth;
use Learner\Http\Controllers\BaseController;

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
     * Personal home page.
     *
     * /user get
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.home')->withUser(Auth::user());
    }
}
