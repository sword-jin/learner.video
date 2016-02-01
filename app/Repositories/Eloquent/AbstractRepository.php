<?php

namespace Learner\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Find instance by gived id.
     *
     * @param integer $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find instance with relation by id.
     *
     * @param  integer $id
     * @param  string|array $relations
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function findByIdWithRelation($id, $relations)
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    /**
     * Delete the instance from the database.
     *
     * @return bool|null
     */
    public function deleteById($id)
    {
        return $this->findById($id)->delete();
    }
}
