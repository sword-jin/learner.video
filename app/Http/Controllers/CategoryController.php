<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;
use Learner\Repositories\CategoryRepositoryInterface;

class CategoryController extends BaseController
{
    /**
     * @var \Learner\Repositories\CategoryRepositoryInterface
     */
    protected $categories;

    /**
     * Instance category repository.
     *
     * @param \Learner\Repositories\CategoryRepositoryInterface $categories
     */
    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Find all series in a category.
     *
     * /categories/{name} get
     *
     * @param  string $name
     *
     * @return \Illuminate\View\View
     */
    public function show($name)
    {
        $category = $this->categories->findRelationByName($name);

        return view('categories.show', compact('category'));
    }
}
