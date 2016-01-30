<?php

namespace Learner\Repositories\Eloquent;

use Carbon\Carbon;
use Learner\Models\Video;
use Learner\Services\Forms\SaveVideoFormService;
use Learner\Repositories\VideoRepositoryInterface;

class VideoRepository extends AbstractRepository implements VideoRepositoryInterface
{
    /**
     * The user relate models.
     *
     * @var array
     */
    protected static $relations = ['series'];

    /**
     * Create a new Video instance.
     *
     * @param \Learner\Models\Video $video
     */
    public function __construct(Video $vide)
    {
        $this->model = $vide;
    }

    /**
     * Create video save-form service.
     *
     * @return \Learner\Services\Forms\CreateVideoFormService
     */
    public function getSaveForm()
    {
        return new SaveVideoFormService();
    }

    /**
     * Return id as key and title as value.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->model->orderBy('published_at', 'DESC')->get();
    }

    /**
     * Create a video.
     *
     * @param  array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $newVideo = $this->getNew();

        $newVideo->title = $data['title'];
        $newVideo->series_id = $data['series_id'];
        $newVideo->description = $data['description'];
        $newVideo->resource_type = $data['resource_type'];
        $newVideo->resource_id = $data['resource_id'];
        $newVideo->image = $data['image'];
        $newVideo->duration = $data['duration'];
        $newVideo->published_at = Carbon::createFromFormat('Y-m-d', $data['published_at']);

        $newVideo->save();

        $newVideo->published_at = $newVideo->published_at->toDateTimeString();

        return $newVideo;
    }

    /**
     * Update video.
     *
     * @param  integer $id
     * @param  array $data
     *
     * @return array
     */
    public function update($id, array $data)
    {
        $video = $this->findById($id);

        $video->update($data);

        return $video;
    }

    /**
     * Delete video.
     *
     * @param  integer $id
     *
     * @return boolean|null
     */
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
