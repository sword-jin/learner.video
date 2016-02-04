<?php

namespace Learner\Repositories;

interface SubscriberRepositoryInterface
{
    /**
     * Store the email.
     *
     * @param  string $email
     *
     * @return boolean
     */
    public function store($email);

    /**
     * Find all email.
     *
     * @param integer $perPage
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listEmailPaginated($perPage = 50);

    /**
     * Delele a subscriber by id.
     *
     * @param  string $email
     *
     * @return boolean
     */
    public function deleteByEmail($email);
}
