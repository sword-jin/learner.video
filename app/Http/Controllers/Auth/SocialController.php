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

        Auth::login($authUser, true);

        flashy()->message(lang('notification.register', 'Register Successfully!'));

        return $this->redirectIntended('/');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        }

        $newUser = User::create([
            'username' => $githubUser->nickname,
            'nickname' => $githubUser->name,
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar
        ]);

        $userRole = Role::whereName('user')->first();
        $newUser->roles()->attach($userRole);

        return $newUser;
    }
}
