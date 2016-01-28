<?php

namespace Learner\Http\Controllers\Admin;

use ImageManager;
use Illuminate\Http\Request;
use Learner\Http\Controllers\Admin\BaseController;
use Learner\Repositories\SeriesRepositoryInterface;

class SeriesController extends BaseController
{
    /**
     * Series repository
     *
     * @var \Learner\Repositories\SeriesRepositoryInterface
     */
    protected $series;

    /**
     * Create a new SeriesController instance.
     *
     * @param \Learner\Repositories\SeriesRepositoryInterface $series
     */
    public function __construct(SeriesRepositoryInterface $series)
    {
        $this->series = $series;
    }

    /**
     * Return all series and relation.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function index()
    {
        return $this->series->findAllWithRelation();
    }

    /**
     * Create a new series.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $form = $this->series->getCreateForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 413);
        }

        $seriesData = $form->getInputData();

        $imagePath = ImageManager::saveSeriesImage($seriesData['image']);

        $data = [
            'title' => $seriesData['title'],
            'description' => $seriesData['description'],
            'image' => $imagePath
        ];

        $series = $this->series->create($data);

        return $this->responseJson(['message' => '系列创建成功', 'data' => $series]);
    }
}
