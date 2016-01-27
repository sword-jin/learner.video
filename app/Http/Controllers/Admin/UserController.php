<?php

namespace Learner\Http\Controllers\Admin;

use Learner\Models\User;
use Illuminate\Http\Request;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\UserRepositoryInterface;

class UserController extends BaseController
{
    /**
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

    public function toggleUserActive(Request $request)
    {
        if ($this->users->toggleActive($request->get('id'))) {
            $message = '用户被重新激活';
        } else {
            $message = '用户冻结成功';
        }

        return $this->responseJson(compact('message'));
    }

    /**
     * Remove user to trash.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeToTrash(Request $request)
    {
        $this->users->remove($request->get('id'));

        return $this->responseJson(['message' => '该用户移动到回收站']);
    }

    /**
     * Delete user from database.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser(Request $request)
    {
        $this->users->delete($request->get('id'));

        return $this->responseJson(['message' => '该用户已经被完全删除']);
    }

    /**
     * Restore the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreUser(Request $request)
    {
        $this->users->restore($request->get('id'));

        return $this->responseJson(['message' => '恢复成功']);
    }
}
