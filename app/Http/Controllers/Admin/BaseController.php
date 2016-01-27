<?php

namespace Learner\Http\Controllers\Admin;

use Learner\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Response json.
     *
     * @param array    $daat
     * @param integer  $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($data, $status = 200)
    {
        return response()->json($data, $status);
    }
}
