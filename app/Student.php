<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'code', 'group_id',
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
