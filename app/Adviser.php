<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    protected $fillable = [
        'name', 'code', 'email', 'phone', 'group_id',
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
