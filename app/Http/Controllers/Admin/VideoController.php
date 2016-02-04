<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use VideoApi;
use Illuminate\Support\Facades\Input;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\VideoRepositoryInterface;
use Learner\Repositories\SeriesRepositoryInterface;

class VideoController extends BaseController
{
    /**
     * Video repository.
     *
     * @var \Learner\Repositories\VideoRepositoryInterface
     */
    protected $videos;

    /**
     * Series repository.
     *
     * @var \Learner\Repositories\SeriesRepositoryInterface
     */
    protected $series;

    /**
     * Instance video repository and series repository.
     *
     * @param \Learner\Repositories\VideoRepositoryInterface  $videos
     * @param \Learner\Repositories\SeriesRepositoryInterface $series
     */
    public function __construct(VideoRepositoryInterface $videos, SeriesRepositoryInterface $series)
    {
        $this->videos = $videos;
        $this->series = $series;
    }

    /**
     * Get all videos.
     *
     * /admin/videos get
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $videos = $this->videos->findAll();
        $series = $this->series->listIdAndTitle();

        return $this->responseJson(compact('videos', 'series'));
    }

    /**
     * Store a video.
     *
     * /admin/videos post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $form = $this->videos->getSaveForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $data = $form->getInputData();

        $resourceInfo = $this->getResourceInfo($data['resource_type'], $data['resource_id']);

        $data['image'] = $resourceInfo['thumbnail_url'];
        $data['duration'] = $resourceInfo['duration'];

        $video = $this->videos->create($data);

        return $this->responseJson(['message' => '成功添加视频', 'video' => $video]);
    }

    /**
     * Update a video.
     *
     * /admin/videos/{id} put
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $form = $this->videos->getSaveForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $data = $form->getInputData();
        // if resource_type and resource_id not change, then not request api.
        if ($this->videos->hasChanged($id, $data['resource_type'], $data['resource_id'])) {
            $resourceInfo = $this->getResourceInfo($data['resource_type'], $data['resource_id']);

            $data['image'] = $resourceInfo['thumbnail_url'];
            $data['duration'] = $resourceInfo['duration'];
        }

        $video = $this->videos->update($id, $data);

        return $this->responseJson(['message' => '成功修改视频', 'video' => $video]);
    }

    /**
     * Delete a video
     *
     * /admin/videos/{id} delete
     *
     * @param  integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory($id)
    {
        if ($this->videos->delete($id)) {
            Log::info(lang('log.deleteVideoSuccess', 'Delete a video.'));

            return $this->responseJson(['message' => '视频删除成功']);
        } else {
            return $this->responseJson(['error' => '出现未知问题'], 202);
        }
    }

    /**
     * Get video information from remote api. (vimeo. youtube. youku)
     *
     * @param  string $type
     * @param  integer $id
     *
     * @return array
     */
    protected function getResourceInfo($type, $id)
    {
        return VideoApi::setType($type)->getVideoDetail($id);
    }
}
