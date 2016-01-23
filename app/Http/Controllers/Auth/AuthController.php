<?php

namespace Learner\Http\Controllers\Auth;

use Validator;
use Learner\Models\User;
use Learner\Http\Controllers\BaseController;
use Learner\Repositories\UserRepositoryInterface;
use Learner\Repositories\RoleRepositoryInterface;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * User Repository.
     *
     * @var \Learner\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Role Repository.
     *
     * @var \Learner\Repositories\RoleRepositoryInterface
     */
    protected $roles;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $users, RoleRepositoryInterface $roles)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = $this->users->create($data);

        $userRole = $this->roles->findByName('user');
        $this->users->attachRole($user, $userRole);

        return $user;
    }
}
