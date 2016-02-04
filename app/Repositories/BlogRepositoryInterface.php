<?php

namespace Learner\Repositories;

interface BlogRepositoryInterface
{
    /**
     * Paginate all published blogs.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllPublishedPaginated($perPage = 10);

    /**
     * Get published blog by id.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Learner\Models\Blog[]
     */
    public function findPublishedById($id);

    /**
     * Get save blog form.
     *
     * @return \Learner\Services\Forms\CreateBlogFormService
     */
    public function getCreateForm();

    /**
     * Get update blog form.
     *
     * @return \Learner\Services\Forms\UpdateBlogFormService
     */
    public function getUpdateForm();

    /**
     * Create new blog.
     *
     * @param  array  $data
     */
    public function create(array $data);

    /**
     * Update new blog.
     *
     * @param  array  $data
     */
    public function update($id, array $data);

    /**
     * Delete a blog.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function delete($id);

    /**
     * Change blog's published status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function togglePublished($id);

    /**
     * Change blog's toped status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function toggleTop($id);

    /**
     * Find all blog with category.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Blog[]
     */
    public function findAllWithRelation();
}
