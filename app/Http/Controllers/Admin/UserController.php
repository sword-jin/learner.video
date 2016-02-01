<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use Auth;
use Learner\Models\User;
use Illuminate\Http\Request;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\UserRepositoryInterface;

class UserController extends BaseController
{
    /**
     * User repository.
     *
     * @var \Learner\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Instance the UserRepositoryInterface.
     *
     * @param \Learner\Repositories\UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Get all active users.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function activeUsers()
    {
        return $this->users->findAllActivePaginated();
    }

    /**
     * Find all not active users paginated.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function notActiveUsers()
    {
        return $this->users->findNotActivePaginated();
    }

    /**
     * Find all users in trash paginated.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\User[]
     */
    public function trashedUsers()
    {
        return $this->users->findTrashedPaginated();
    }

    /**
     * Toggle user active.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleUserActive($id)
    {
        if ($this->users->toggleActive($id)) {
            $message = '用户被重新激活';
        } else {
            $message = '用户冻结成功';
        }

        return $this->responseJson(compact('message'));
    }

    /**
     * Remove user to trash.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeToTrash($id)
    {
        $this->users->remove($id);

        Log::info(Auth::user()->username . ': ' . lang('log.removeUserSuccess', 'delete a user to trash.'));

        return $this->responseJson(['message' => '该用户移动到回收站']);
    }

    /**
     * Delete user from database.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        $this->users->delete($id);

        Log::info(Auth::user()->username . ': ' . lang('log.deleteUserSuccess', 'delete a user.'));

        return $this->responseJson(['message' => '该用户已经被完全删除']);
    }

    /**
     * Restore the user.
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreUser($id)
    {
        $this->users->restore($id);

        return $this->responseJson(['message' => '恢复成功']);
    }
}
