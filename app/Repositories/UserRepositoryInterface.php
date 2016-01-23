<?php

namespace Learner\Repositories;

use Learner\Models\User;

interface UserRepositoryInterface
{
    /**
     * Create a new user in the database.
     *
     * @param  array  $data
     *
     * @return \Learner\Models\User
     */
    public function create(array $data);

    /**
     * Attach a role to user.
     *
     * @param  Learner\Models\User $user
     * @param  mixed $roleOrRoleId
     */
    public function attachRole(User $user, $roleOrRoleId);
}
