<?php

namespace Learner\Http\Controllers\Admin;

use Log;
use Auth;
use Hash;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $form = $this->series->getCreateForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $seriesData = $form->getInputData();

        $series = $this->series->create([
            'title' => $seriesData['title'],
            'description' => $seriesData['description'],
            'image' => ImageManager::saveSeriesImage($seriesData['image'])
        ]);

        return $this->responseJson(['message' => '系列创建成功', 'data' => $series]);
    }

    /**
     * Update series.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $form = $this->series->getUpdateForm();

        if (! $form->isValid()) {
            return $this->responseJson(['errors' => $form->getErrors()], 400);
        }

        $seriesData = $form->getInputData();
        $data = [
            'title' => $seriesData['title'],
            'description' => $seriesData['description'],
        ];

        if (key_exists('image', $seriesData)) {
            $imagePath = ImageManager::changeSeriesImage(
                    $seriesData['image'],
                    $this->series->findImageById($id)
            );

            $data['image'] = $imagePath;
        }

        $series = $this->series->update($id, $data);

        return $this->responseJson(['message' => '系列修改成功', 'data' => $series]);
    }

    /**
     * Delete series.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory(Request $request, $id)
    {
        $truePassword = Auth::user()->password;

        if (Hash::check($request->get('password'), $truePassword)) {
            // delete image.
            ImageManager::delete($this->series->findImageById($id));
            // remove from db.
            $this->series->deleteById($id);

            Log::warning(lang("log.deleteSeriesSuccess", "You delete a series."));
            return $this->responseJson(['message' => '删除成功！']);
        }

        Log::warning(lang("log.deleteSeriesError", "MayBe Someone want delete your series."));
        return $this->responseJson(['error' => '密码错误，记录日志'], 403);
    }
}
