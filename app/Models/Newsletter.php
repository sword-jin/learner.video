<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'is_published'
    ];

    /**
     * Format the output.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'bool'
    ];

    /**
     * A newsletter has many links.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function links()
    {
        return $this->hasMany('Learner\Models\Link');
    }
}
