<?php

namespace Learner\Http\Controllers\Admin;

use Learner\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * Return admin single page.
     *
     * /admin get
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.layouts.master');
    }
}
