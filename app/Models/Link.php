<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'newsletter_id',
        'title',
        'link',
        'type',
        'domain',
        'note',
    ];

    /**
     * A link belongs to a newsletter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function newsletter()
    {
        return $this->belongsTo('Learner\Models\Newsletter');
    }
}
