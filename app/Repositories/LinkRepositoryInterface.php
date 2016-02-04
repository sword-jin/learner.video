<?php

namespace Learner\Repositories;

interface LinkRepositoryInterface
{
    /**
     * Get the link save form
     *
     * @return \Learner\Services\Forms\SaveLinkFormService
     */
    public function getSaveForm();

    /**
     * Store a link.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function store(array $data);

    /**
     * Update link.
     *
     * @param  integer $id
     * @param  array  $data
     *
     * @return array
     */
    public function update($id, array $data);

    /**
     * Get all link with paginator.
     *
     * @param $perPage = 50
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Learner\Models\Link[]
     */
    public function findAllPaginated($perPage = 50);

    /**
     * Delete a link.
     *
     * @param  integer $id
     */
    public function delete($id);
}
