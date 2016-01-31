<?php

namespace Learner\Http\Controllers\Admin;

use Learner\Http\Controllers\Admin\BaseController;

class BlogController extends BaseController
{
    protected $blogs;

    public function __construct(BlogRepositoryInterface $blogs)
    {
        $this->blogs = $blogs;
    }

    public function index()
    {
        //
    }
}
