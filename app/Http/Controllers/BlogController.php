<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;
use Learner\Repositories\BlogRepositoryInterface;

class BlogController extends BaseController
{
    /**
     * Blog repository.
     *
     * @var \Learner\Repositories\BlogRepositoryInterface
     */
    protected $blogs;

    /**
     * Instance blog repository.
     *
     * @param \Learner\Repositories\BlogRepositoryInterface $blogs
     */
    public function __construct(BlogRepositoryInterface $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * Get all published blogs.
     *
     * /blogs get
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $blogs = $this->blogs->findAllPublishedPaginated(10);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show blog.
     *
     * /blogs/{id} get
     *
     * @param  integer $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $blog = $this->blogs->findPublishedById($id);

        return view('blogs.show', compact('blog'));
    }
}
