<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;
use Learner\Repositories\SeriesRepositoryInterface;

class PageController extends BaseController
{
    /**
     * Series repository.
     *
     * @var Learner\Repositories\SeriesRepositoryInterface
     */
    protected $series;

    /**
     * Instance series repository.
     *
     * @param \Learner\Repositories\SeriesRepositoryInterface $series
     */
    public function __construct(SeriesRepositoryInterface $series)
    {
        $this->series = $series;
    }

    /**
     * Home page. /
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $series = $this->series->findAllWithRelationHavePublishedVideoLimit();

        return view('pages.index', compact('series'));
    }
}
