<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

}
