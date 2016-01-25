<?php

namespace Learner\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Learner\Http\Requests;
use Learner\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.layouts.master');
    }
}
