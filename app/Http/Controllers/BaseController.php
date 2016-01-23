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
        return Redirect::route($route, $params)->with($data);
    }
}
