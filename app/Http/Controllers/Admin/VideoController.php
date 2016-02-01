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
     * Video repository
     *
     * @var
     */
    protected $videos;

    public function __construct(VideoRepositoryInterface $videos, SeriesRepositoryInterface $series)
    {
        $this->videos = $videos;
        $this->series = $series;
    }

    public function index()
    {
        $videos = $this->videos->findAll();
        $series = $this->series->listIdAndTitle();

        return $this->responseJson(compact('videos', 'series'));
    }

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

    public function destory($id)
    {
        if ($this->videos->delete($id)) {
            Log::info(lang('log.deleteVideoSuccess', 'Delete a video.'));

            return $this->responseJson(['message' => '视频删除成功']);
        } else {
            return $this->responseJson(['error' => '出现未知问题'], 202);
        }
    }

    protected function getResourceInfo($type, $id)
    {
        return VideoApi::setType($type)->getVideoDetail($id);
    }
}
