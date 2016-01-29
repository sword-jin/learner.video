<?php

namespace Learner\Repositories;

interface SeriesRepositoryInterface
{
    /**
     * Get the user creation form service.
     *
     * @return \Learner\Services\Forms\CreateSeriesFormService.
     */
    public function getCreateForm();

    /**
     * Get the user updation form service.
     *
     * @return \Learner\Services\Forms\UpdateSeriesFormService.
     */
    public function getUpdateForm();

    /**
     * Create a new Series.
     *
     * @param  array $data
     *
     * @return array
     */
    public function create($data);

    /**
     * Find image path by id.
     *
     * @param  integer $id
     *
     * @return string
     */
    public function findImageById($id);

    /**
     * Update Series by id.
     *
     * @param  integer $id
     * @param  array   $data
     *
     * @return array
     */
    public function update($id, $data);

    /**
     * Return all series and relation.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelation();
}
