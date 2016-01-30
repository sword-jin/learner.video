<?php

namespace Learner\Http\Controllers\Admin;

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

        $video = $this->videos->create($form->getInputData());

        return $this->responseJson(['message' => '成功添加视频', 'video' => $video]);
    }

    public function update($id)
    {
        $form = $this->videos->getSaveForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $video = $this->videos->update($id, $form->getInputData());

        return $this->responseJson(['message' => '成功修改视频', 'video' => $video]);
    }

    public function restory($id)
    {
        if ($this->videos->delete($id)) {
            return $this->responseJson(['message' => '视频删除成功']);
        } else {
            return $this->responseJson(['error' => '未知错误'], 202);
        }
    }
}
