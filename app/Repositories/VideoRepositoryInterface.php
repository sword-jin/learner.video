<?php

namespace Learner\Repositories;

interface VideoRepositoryInterface
{
    /**
     * Create video save-form service.
     *
     * @return \Learner\Services\Forms\CreateVideoFormService
     */
    public function getSaveForm();

    /**
     * Return id as key and title as value.
     *
     * @return array
     */
    public function findAll();

    /**
     * Check the video resource changed.
     *
     * @param  integer  $id
     * @param  string  $resource_type
     * @param  string  $resource_id
     *
     * @return boolean
     */
    public function hasChanged($id, $resource_type, $resource_id);

    /**
     * Create a video.
     *
     * @param  array $data
     *
     * @return array
     */
    public function create(array $data);

    /**
     * Update video.
     *
     * @param  integer $id
     * @param  array $data
     *
     * @return array
     */
    public function update($id, array $data);

    /**
     * Delete video.
     *
     * @param  integer $id
     *
     * @return boolean|null
     */
    public function delete($id);

    /**
     * Paniaget the all videos.
     *
     * @param  integer $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllPublishedPaginated($perPage = 50);
}
