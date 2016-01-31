<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Blog;
use Learner\Repositories\BlogRepositoryInterface;

class BlogRepository extends AbstractRepository implements BlogRepositoryInterface
{
    /**
     * Create a new Blog instance.
     *
     * @param \Learner\Models\Blog $blog
     */
    public function __construct(Blog $role)
    {
        $this->model = $role;
    }
}
