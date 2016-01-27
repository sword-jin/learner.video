<?php

namespace Learner\Http\Controllers;

use Illuminate\Http\Request;

use Learner\Http\Requests;
use Learner\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}
