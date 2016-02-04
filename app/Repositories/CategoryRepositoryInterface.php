<?php

namespace Learner\Repositories;

interface CategoryRepositoryInterface
{
    /**
     * Get create form service.
     *
     * @return \Learner\Services\Forms\CreateCategoryFormService
     */
    public function getCreateForm();

    /**
     * Get update form service.
     *
     * @return \Learner\Services\Forms\UpdateCategoryFormService
     */
    public function getUpdateForm();

    /**
     * Find all categories.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function findAll();

    /**
     * List all category's name and image with relation
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function listNameAndImageWithRelation();

    /**
     * List id and name. (for admin)
     *
     * @return array
     */
    public function listIdAndName();

    /**
     * Create new category.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function create(array $data);

    /**
     * Update category by id.
     *
     * @param  integer $id
     * @param  array  $data
     *
     * @return array
     */
    public function update($id, array $data);

    /**
     * Find image path by id.
     *
     * @param  integer $id
     *
     * @return string
     */
    public function findImageById($id);

    /**
     * Find category relation by name.
     *
     * @param  string $name
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Category[]
     */
    public function findRelationByName($name);
}
