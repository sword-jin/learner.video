<?php

namespace Learner\Repositories\Eloquent;

use Learner\Models\Series;
use Learner\Repositories\SeriesRepositoryInterface;
use Learner\Services\Forms\CreateSeriesFormService;

class SeriesRepository extends AbstractRepository implements SeriesRepositoryInterface
{
    /**
     * The user relate models.
     *
     * @var string
     */
    protected static $relations = 'videos';

    /**
     * Create a new Series instance.
     *
     * @param \Learner\Models\Series $series
     */
    public function __construct(Series $series)
    {
        $this->model = $series;
    }

    /**
     * Get the user creation form service.
     *
     * @return \Learner\Services\Forms\CreateSeriesFormService.
     */
    public function getCreateForm()
    {
        return new CreateSeriesFormService;
    }

    /**
     * Create a new Series
     *
     * @param  array $data
     *
     * @return array
     */
    public function create($data)
    {
        $newSeries = $this->getNew();

        $newSeries->title = $data['title'];
        $newSeries->description = $data['description'];
        $newSeries->image = $data['image'];

        $newSeries->save();

        return [
            'id' => $newSeries['id'],
            'title' => $newSeries['title'],
            'image' => $newSeries['image'],
            'description' => $newSeries['description']
        ];
    }

    /**
     * Return all series and relation.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelation()
    {
        return $this->model->with(self::$relations)->get();
    }
}
