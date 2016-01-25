<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Role;
use Learner\Repositories\RoleRepositoryInterface;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    /**
     * Create a new Role instance.
     *
     * @param \Learner\Models\Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * Find a role by it's name.
     *
     * @param  string $name
     *
     * @return \Learner\Models\Role
     */
    public function findByName($name)
    {
        return $this->model->whereName($name)->firstOrFail();
    }
}
