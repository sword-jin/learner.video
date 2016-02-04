<?php

namespace Learner\Repositories;

interface NewsletterRepositoryInterface
{
    /**
     * Find all newsletter.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll();

    /**
     * Find all published newsletters.
     *
     * @param  integer $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllPublishedWithPaginator($perPage = 10);

    /**
     * Find published newsletter by id.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findPublishedWithRelationById($id);

    /**
     * Store a new newsletter.
     *
     * @param  string $title
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store($title);

    /**
     * Delete a newsletter.
     *
     * @param  integer $id
     */
    public function delete($id);

    /**
     * Get all link of given ids' newsletter
     *
     * @param  integer $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNewletterLinkById($id);
}
