<?php

namespace Learner\Repositories\Eloquent;

use Carbon\Carbon;
use Learner\Models\Video;
use Learner\Repositories\VideoRepositoryInterface;
use Learner\Services\Forms\CreateVideoFormService;

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
     * Create video create-form service.
     *
     * @return \Learner\Services\Forms\CreateVideoFormService
     */
    public function getCreateForm()
    {
        return new CreateVideoFormService();
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
     * Create a new Series.
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
        $newVideo->published_at = Carbon::createFromFormat('Y-m-d', $data['published_at']);

        $newVideo->save();

        return $this->findByIdWithRelation($newVideo->id, static::$relations)
                    ->toArray();
    }
}
