<?php

namespace Learner\Services\Layouts;

use Cache;
use Learner\Repositories\CategoryRepositoryInterface;

class Category
{
    /**
     * All categories.
     *
     * @var array
     */
    protected $categories = [];

    /**
     * Category Reposotiry.
     *
     * @var \Learner\Repositories\CategoryRepositoryInterface
     */
    protected $cateRepository;

    /**
     * Cache the category.
     *
     * @param \Learner\Repositories\CategoryRepositoryInterface $cateRepository
     */
    public function __construct(CategoryRepositoryInterface $cateRepository)
    {
        $this->cateRepository = $cateRepository;

        if (! Cache::has('categories')) {
            $categories = $this->cateRepository->listNameAndImageWithRelation();

            Cache::put('categories', $categories, 24 * 60);
        }

        $this->categories = Cache::get('categories');
    }

    /**
     * Get the category in cache.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
