<?php

namespace Learner\Repositories;

interface RoleRepositoryInterface
{
    /**
     * Find a role by it's name.
     *
     * @param  string $name
     *
     * @return \Learner\Models\Role
     */
    public function findByName($name);
}
