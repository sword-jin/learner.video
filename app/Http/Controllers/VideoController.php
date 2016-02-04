<?php

namespace Learner\Http\Controllers;

use Learner\Http\Controllers\BaseController;
use Learner\Repositories\VideoRepositoryInterface;

class VideoController extends BaseController
{
    /**
     * Video Repository.
     *
     * @var \Learner\Repositories\VideoRepositoryInterface
     */
    protected $videos;

    /**
     * Instance video repository.
     *
     * @param \Learner\Repositories\VideoRepositoryInterface $videos
     */
    public function __construct(VideoRepositoryInterface $videos)
    {
        $this->videos = $videos;
    }

    /**
     * Get video by paginator.
     *
     * /videos get
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $videos = $this->videos->findAllPublishedPaginated(20);

        return view('videos.index', compact('videos'));
    }
}
