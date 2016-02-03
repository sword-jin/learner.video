<?php

namespace Learner\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Learner\Repositories\RoleRepositoryInterface;
use Learner\Repositories\UserRepositoryInterface;
use Learner\Http\Controllers\Admin\BaseController;

class RoleController extends BaseController
{
    /**
     * Role repository.
     *
     * @var \Learner\Repositories\RoleRepositoryInterface
     */
    protected $roles;

    /**
     * User repository.
     *
     * @var \Learner\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Instance role, user repository.
     *
     * @param \Learner\Repositories\RoleRepositoryInterface $roles
     * @param \Learner\Repositories\UserRepositoryInterface $users
     */
    public function __construct(RoleRepositoryInterface $roles, UserRepositoryInterface $users)
    {
        $this->roles = $roles;
        $this->users = $users;
    }

    /**
     * Get all roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = $this->roles->listAll();

        return $this->responseJson(compact('roles'));
    }

    /**
     * Assign user roles.
     *
     * @param  interger $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(Request $request, $id)
    {
        $roles = $request->get('roles');

        if (empty($roles)) {
            return $this->responseJson(['error' => '请选择一个角色'], 400);
        }

        $user = $this->users->attachRoleById($id, $roles);

        return $this->responseJson([
            'user' => $user,
            'message' => '分配成功'
        ]);
    }
}
