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

    /**
     * Get create form service.
     *
     * @return \Learner\Services\Forms\CreateCategoryFormService
     */
    public function getCreateForm()
    {
        return new CreateCategoryFormService;
    }

    /**
     * Get update form service.
     *
     * @return \Learner\Services\Forms\UpdateCategoryFormService
     */
    public function getUpdateForm()
    {
        return new UpdateCategoryFormService;
    }

    /**
     * Find all categories.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function findAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    /**
     * List all category's name and image with relation
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function listNameAndImageWithRelation()
    {
        return $this->model
                    ->select('id', 'name', 'image')
                    ->with('series')
                    ->get();
    }

    /**
     * List id and name. (for admin)
     *
     * @return array
     */
    public function listIdAndName()
    {
        return $this->model->select('name', 'id')->get();
    }

    /**
     * Create new category.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $new = $this->getNew();

        $new->name = strtolower($data['name']);
        $new->image = $data['image'];

        $new->save();

        return $new->toArray();
    }

    /**
     * Update category by id.
     *
     * @param  integer $id
     * @param  array  $data
     *
     * @return array
     */
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

    /**
     * Find category relation by name.
     *
     * @param  string $name
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function findRelationByName($name)
    {
        return $this->model
                    ->with('series.videos')
                    ->where('name', $name)
                    ->firstOrFail();
    }
}
