<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * A category has many series
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function series()
    {
        return $this->belongsToMany('Learner\Models\Series');
    }

    /**
     * A Category has many blogs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('Learner\Models\Blog');
    }
}
