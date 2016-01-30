<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;

class BlogController extends BaseController
{
    public function index()
    {
        return view('blogs.index');
    }
}
