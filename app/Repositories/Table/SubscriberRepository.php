<?php

namespace Learner\Repositories\Table;

use Learner\Repositories\SubscriberRepositoryInterface;

class SubscriberRepository extends AbstractTableRepository implements SubscriberRepositoryInterface
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $tableName = 'subscribers';

    /**
     * Store the email.
     *
     * @param  string $email
     *
     * @return boolean
     */
    public function store($email)
    {
        if ($this->exists($email)) {
            return false;
        }

        $this->table->insert([
            'email' => $email
        ]);

        return true;
    }

    /**
     * Whether the email exists in db.
     *
     * @param  integer $email
     *
     * @return boolean
     */
    public function exists($email)
    {
        return $this->table->whereEmail($email)->count() !== 0;
    }

    /**
     * Find all email.
     *
     * @param integer $perPage
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listEmailPaginated($perPage = 50)
    {
        return $this->table->paginate($perPage);
    }

    /**
     * Delele a subscriber by id.
     *
     * @param  string $email
     *
     * @return boolean
     */
    public function deleteByEmail($email)
    {
        return $this->table->whereEmail($email)->delete();
    }
}
