<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'name', 'start_date', 'end_date', 'period_id',
    ];

    public function period()
    {
        return $this->belongsTo('App\Period');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

}
