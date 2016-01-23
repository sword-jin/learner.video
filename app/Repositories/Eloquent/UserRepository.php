<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\User;
use Learner\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * Create a new User instance.
     *
     * @param \Learner\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Create a new user in the database.
     *
     * @param  array  $data
     *
     * @return \Learner\Models\User
     */
    public function create(array $data)
    {
        $user = $this->getNew();

        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = encrypt($data['password']);

        $user->save();

        return $user;
    }

    /**
     * attach a role to user.
     *
     * @param \Learner\Models\User $user
     * @param  mixed $roleOrRoleId
     */
    public function attachRole(User $user, $roleOrRoleId)
    {
        $user->roles()->attach($roleOrRoleId);
    }
}
