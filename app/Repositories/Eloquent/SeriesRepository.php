<?php

namespace Learner\Repositories\Eloquent;

use DB;
use Carbon\Carbon;
use Learner\Models\Series;
use Learner\Repositories\SeriesRepositoryInterface;
use Learner\Services\Forms\CreateSeriesFormService;
use Learner\Services\Forms\UpdateSeriesFormService;

class SeriesRepository extends AbstractRepository implements SeriesRepositoryInterface
{
    /**
     * The seires relate models.
     *
     * @var array
     */
    protected static $relations = ['videos', 'categories'];

    /**
     * Create a new Series instance.
     *
     * @param \Learner\Models\Series $series
     */
    public function __construct(Series $series)
    {
        $this->model = $series;
    }

    public function listIdAndTitle()
    {
        return $this->model->select('id', 'title')->get();
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
     * Get the user updation form service.
     *
     * @return \Learner\Services\Forms\UpdateSeriesFormService.
     */
    public function getUpdateForm()
    {
        return new UpdateSeriesFormService;
    }

    /**
     * Create a new Series.
     *
     * @param  array $data
     *
     * @return array
     */
    public function create($data)
    {
        $newSeries = $this->getNew();

        $newSeries->title = $data['title'];
        $newSeries->slug = str_slug($data['slug']);
        $newSeries->description = $data['description'];
        $newSeries->image = $data['image'];

        $newSeries->save();

        $newSeries->categories()->sync($data['categories']);

        return $this->findByIdWithRelation($newSeries->id, static::$relations)
                    ->toArray();
    }

    /**
     * Find image path by id.
     *
     * @param  integer $id
     *
     * @return string
     */
    public function findImageById($id)
    {
        return array_get($this->findById($id), 'image');
    }

    /**
     * Update Series by id.
     *
     * @param  integer $id
     * @param  array   $data
     *
     * @return array
     */
    public function update($id, $data)
    {
        $series = $this->findById($id);

        $series->update(array_only($data, ['title', 'image', 'description']));

        $series->categories()->sync($data['categories']);

        return $this->findByIdWithRelation($series->id, static::$relations)
                    ->toArray();
    }

    /**
     * Return all series and relation.
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelation()
    {
        return $this->model
                    ->with(self::$relations)
                    ->get();
    }

    /**
     * Return series and relation. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationHavePublishedVideo()
    {
        return $this->model
                    ->with(['videos' => function($query) {
                        $query->where('published_at', '<=', Carbon::now());
                    }])
                    ->with('categories')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    /**
     * Limit series and relation. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationHavePublishedVideoLimit($limit = 4)
    {
        return $this->model
                    ->with(['videos' => function($query) {
                        $query->where('published_at', '<=', Carbon::now());
                    }])
                    ->with('categories')
                    ->orderBy('created_at', 'DESC')
                    ->limit(4)
                    ->get();
    }

    /**
     * Return series and relation by slug. (video is published.)
     *
     * @return Illuminate\Database\Eloquent\Collection|\Learner\Models\Series[]
     */
    public function findAllWithRelationBySlug($slug)
    {
        return $this->model
                    ->with('categories')
                    ->with(['videos' => function($query) {
                        $query->where('published_at', '<=', Carbon::now());
                    }])
                    ->whereSlug($slug)
                    ->firstOrFail();
    }
}
