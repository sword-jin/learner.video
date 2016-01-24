<?php

namespace Learner\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

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
        return Redirect::route($route, $params)->with($data);
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
        return Redirect::back()->withInput()->with($data);
    }
}
