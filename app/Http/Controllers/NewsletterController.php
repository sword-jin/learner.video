<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;

class NewsletterController extends BaseController
{
    public function index()
    {
        return view('newsletters.index');
    }
}
