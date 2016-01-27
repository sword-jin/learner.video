<?php

namespace Learner\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'avatar', 'is_active', 'deleted_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Format the output.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'bool'
    ];

    /**
     * Eager load relations on the model.
     *
     * @return $this
     */
    public function relations()
    {
        return $this->load('roles.perms');
    }

    /**
     * Whether the user is not active.
     *
     * @return boolean
     */
    public function isNotActive()
    {
        return (boolean) ! $this->is_active;
    }
}
