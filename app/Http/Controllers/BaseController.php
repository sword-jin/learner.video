<?php

namespace Learner\Http\Controllers;

class BaseController extends Controller
{
    /**
     * Redirect to the specified named route.
     *
     * @param string $route
     * @param array  $params
     * @param array  $data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToRoute($route, $params = [], $data = [])
    {
        return redirect()->route($route, $params)->with($data);
    }

    /**
     * Redirect back with old input and the specified data.
     *
     * @param array $data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($data = [])
    {
        return redirect()->back()->withInput()->with($data);
    }

    /**
     * Redirect a logged in user to the previously intended url.
     *
     * @param mixed $default
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectIntended($default = null)
    {
        return redirect()->intended($default);
    }

    /**
     * Redirect to back with errors.
     *
     * @param array $errors
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBackWithErrors($errors = null)
    {
        return redirect()->back()->withInput()->withErrors($errors);
    }
}
