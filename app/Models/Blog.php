<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'category_id', 'is_published', 'is_top'
    ];

    /**
     * Format the output.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'bool',
        'is_top' => 'bool'
    ];

    /**
     * A Blog belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Learner\Models\Category');
    }
}
