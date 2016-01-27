<?php

namespace Learner\Http\Controllers\Admin;

use DB;
use Learner\Models\Role;
use Illuminate\Support\Facades\Auth;
use Learner\Repositories\UserRepositoryInterface;
use Learner\Http\Controllers\Admin\BaseController;

class InfoController extends BaseController
{
    /**
     * Some information.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Get the auth user information.
     *
     * @return [type] [description]
     */
    public function auth()
    {
        return Auth::user()->relations();
    }

    /**
     * Get some data to dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboard()
    {
        // get user number.
        $this->data['user_count'] = DB::table('users')->count();
        // get all roles.
        $this->data['all_roles'] = Role::with(['users', 'perms'])->get();
        // get all permissions ... now not work for me.
        // $this->data['all_perms'] = Permission::all();

        return $this->responseJson(['info' => $this->data]);
    }
}
