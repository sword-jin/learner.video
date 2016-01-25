<?php

namespace Learner\Http\Controllers\Auth;

use Auth;
use Validator;
use Learner\Models\User;
use Illuminate\Http\Request;
use Learner\Http\Controllers\BaseController;
use Learner\Repositories\RoleRepositoryInterface;
use Learner\Repositories\UserRepositoryInterface;

class AuthController extends BaseController
{
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
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Show the application register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth/register');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            flashy()->success(lang('notification.login', 'Welcome to Learner!'));

            return $this->redirectIntended('/');
        }

        return $this->redirectBackWithErrors(['other' => trans('auth.failed')]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister()
    {
        $form = $this->users->getRegisterForm();

        if (! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        Auth::login($this->create($form->getInputData()));

        flashy()->message(lang('notification.register', 'Register Successfully!'));

        return $this->redirectIntended('/');
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

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        flashy()->info(
            lang('notification.logout', 'Logout successfully!'),
            link_to_route('auth.login'));

        return $this->redirectIntended('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function loginUsername()
    {
        return 'credential';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credential = $request->get('credential');

        $credential_key = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $credential_key => $credential,
            'password'      => $request->get('password')
        ];
    }
}
