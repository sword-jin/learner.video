<?php

namespace Learner\Http\Controllers\Auth;

use Auth;
use Socialite;
use Learner\Models\Role;
use Learner\Models\User;
use Learner\Http\Controllers\BaseController;

class SocialController extends BaseController
{
    /**
     * Only guest can access this controller.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToTwitter()
    {
        flashy()->warning("twitter 暂时无法使用");

        return $this->redirectToRoute('home');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleTwitterOAuth()
    {
        // ...
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubOAuth()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return $this->redirectIntended('auth/github');
        }

        $authUser = $this->findOrCreateUser($user);

        if (is_array($authUser)) {
            Auth::login($authUser[0], true);
            flashy()->mutedDark('注册成功，不过用户名可能要自己改个酷酷的');

            return $this->redirectToRoute('user.profile');
        } else {
            Auth::login($authUser, true);
            flashy()->message(lang('notification.register', 'Register Successfully!'));

            return $this->redirectIntended('/');
        }
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     *
     * @return \Learner\Models\User|array
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        }

        // username exist, add a random string and return use profile page.
        if (User::where('username', $githubUser->nickname)->first()) {
            $githubUser->nickname .= uniqid();

            $user = $this->createAUser($githubUser->nickname, $githubUser->name, $githubUser->email, $githubUser->avatar);

            return [$user];
        }

        return $this->createAUser($githubUser->nickname, $githubUser->name, $githubUser->email, $githubUser->avatar);
    }

    /**
     * Create a new user.
     *
     * @return \Learner\Models\User
     */
    protected function createAUser()
    {
        $args = func_get_args();

        $newUser = User::create([
            'username' => $args[0],
            'nickname' => $args[1],
            'email' => $args[2],
            'avatar' => $args[3]
        ]);

        $userRole = Role::whereName('user')->first();
        $newUser->roles()->attach($userRole);

        return $newUser;
    }
}
