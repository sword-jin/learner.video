<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'series_id',
        'duration',
        'image',
        'description',
        'resource_type',
        'resource_id',
        'published_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $datas = ['published_at'];

    /**
     * A Video belongs to a serie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo('Learner\Models\Series');
    }
}
