<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;

class VideoController extends BaseController
{
    public function index()
    {
        //

        return view('videos.index');
    }
}
