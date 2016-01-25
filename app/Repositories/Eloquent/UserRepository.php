<?php

namespace Learner\Repositories\Eloquent;

use Hash;
use Learner\Models\User;
use Learner\Services\Forms\UserRegisterFormService;
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
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);

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

    /**
     * Get the user creation form service.
     *
     * @return \Learner\Services\Forms\UserRegisterFormService.
     */
    public function getRegisterForm()
    {
        return new UserRegisterFormService;
    }
}
