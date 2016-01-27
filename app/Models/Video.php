<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{


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
