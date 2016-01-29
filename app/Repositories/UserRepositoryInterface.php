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

    /**
     * Get the user creation form service.
     *
     * @return \Learner\Services\Forms\UserRegisterFormService.
     */
    public function getRegisterForm();

    /**
     * Find user by id with trashed.
     *
     * @param  integer $id
     *
     * @return \Learner\Models\User
     */
    public function findWithTrashedById($id);

    /**
     * Find all users paginated.
     *
     * @param int $perPage
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findAllActivePaginated($perPage = 50);

    /**
     * Find all not active users paginated.
     *
     * @param int $perPage
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findNotActivePaginated($perPage = 50);

    /**
     * Find all users in trash paginated.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findTrashedPaginated($perPage = 50);

    /**
     * Update user.
     *
     * @param  integer $id
     * @param  array  $attributes
     */
    public function update($id, array $attributes);

    /**
     * Remove the user to trash.
     *
     * @param  integer $id
     */
    public function remove($id);

    /**
     * Delete user from database and remove avatar.
     *
     * @param  integer $id
     */
    public function delete($id);

    /**
     * Restore a user from trash.
     *
     * @param  integer $id
     */
    public function restore($id);

    /**
     * Change user's status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function toggleActive($id);
}
