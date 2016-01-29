<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Category;
use Learner\Repositories\CategoryRepositoryInterface;
use Learner\Services\Forms\CreateCategoryFormService;
use Learner\Services\Forms\UpdateCategoryFormService;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new Category instance.
     *
     * @param \Learner\Models\Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCreateForm()
    {
        return new CreateCategoryFormService;
    }

    public function getUpdateForm()
    {
        return new UpdateCategoryFormService;
    }

    public function findAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function listAll()
    {
        return $this->model->select('name', 'id')->get();
    }

    public function create(array $data)
    {
        $new = $this->getNew();

        $new->name = strtolower($data['name']);
        $new->image = $data['image'];

        $new->save();

        return $new->toArray();
    }

    public function update($id, array $data)
    {
        $category = $this->findById($id);

        $category->update($data);

        return $category->toArray();
    }

    /**
     * Find image path by id.
     *
     * @param  integer $id
     *
     * @return string
     */
    public function findImageById($id)
    {
        return array_get($this->findById($id), 'image');
    }
}
