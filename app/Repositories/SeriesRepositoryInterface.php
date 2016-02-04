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
     * List all series' id and title for categories list.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function listIdAndTitle();

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

    /**
     * Return series and relation. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationHavePublishedVideo();

    /**
     * Limit series and relation for home page. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationHavePublishedVideoLimit($limit = 4);

    /**
     * Return series and relation by slug. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationBySlug($slug);
}
