<?php

namespace Learner\Http\Controllers\Admin;

use Learner\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return view('admin.layouts.master');
    }
}
