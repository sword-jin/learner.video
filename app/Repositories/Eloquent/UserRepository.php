<?php

namespace Learner\Repositories\Eloquent;

use Hash;
use AvatarManager;
use Carbon\Carbon;
use Learner\Models\User;
use Learner\Repositories\UserRepositoryInterface;
use Learner\Services\Forms\UserRegisterFormService;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * The user relate models.
     *
     * @var array
     */
    protected static $relations = ['roles.perms'];

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

        $user->email    = $data['email'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->avatar   = AvatarManager::generateAvatar($user->username);

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

    /**
     * Find user by id with trashed.
     *
     * @param  integer $id
     *
     * @return \Learner\Models\User
     */
    public function findWithTrashedById($id)
    {
        return $this->model->withTrashed()->findOrFail($id);
    }

    /**
     * Give user one or more roles.
     *
     * @param  integer $userId
     * @param  array $roleIds
     *
     * @return \Learner\Models\User
     */
    public function attachRoleById($userId, $roleIds)
    {
        $user = $this->findWithTrashedById($userId);
        $user->roles()->sync($roleIds);

        return $this->model
                    ->withTrashed()
                    ->with(['roles'])
                    ->findOrFail($userId);
    }

    /**
     * Find all active users paginated.
     *
     * @param int $perPage
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findAllActivePaginated($perPage = 50)
    {
        return $this->model
                    ->with(self::$relations)
                    ->where('is_active', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * Find all not active users paginated.
     *
     * @param int $perPage
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findNotActivePaginated($perPage = 50)
    {
        return $this->model
                    ->with(self::$relations)
                    ->where('is_active', false)
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * Find all users in trash paginated.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function findTrashedPaginated($perPage = 50)
    {
        return $this->model
            ->with(self::$relations)
            ->onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Update user.
     *
     * @param  integer $id
     * @param  array  $attributes
     */
    public function update($id, array $attributes)
    {
        $user = $this->findWithTrashedById($id);

        $user->update($attributes);
    }

    /**
     * Remove the user to trash.
     *
     * @param  integer $id
     */
    public function remove($id)
    {
        $user = $this->update($id, [
            'deleted_at' => Carbon::now()
        ]);
    }

    /**
     * Delete user from database and remove avatar.
     *
     * @param  integer $id
     */
    public function delete($id)
    {
        $user = $this->findWithTrashedById($id);

        AvatarManager::delete($user->avatar);

        $user->forceDelete();
    }

    /**
     * Restore a user from trash.
     *
     * @param  integer $id
     */
    public function restore($id)
    {
        $user = $this->update($id, [
            'deleted_at' => null
        ]);
    }

    /**
     * Change user's status.
     *
     * @param  integer $id
     *
     * @return boolean
     */
    public function toggleActive($id)
    {
        $user = $this->findWithTrashedById($id);

        $user->update([
            'is_active' => ! $user->is_active
        ]);

        return $user->is_active;
    }
}
