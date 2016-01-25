<?php

namespace Learner\Http\Controllers\Auth;

use Learner\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /**
     * When reset password successfully to redirect this path.
     *
     * @var string
     */
    protected $redirectPath = '/';

    /**
     * Use laravel active password reset interface.
     */
    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
