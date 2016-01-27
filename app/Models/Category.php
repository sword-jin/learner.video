<?php

namespace Learner\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    /**
     * A category has many series
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function series()
    {
        return $this->hasMany('Learner\Models\Serie');
    }
}
