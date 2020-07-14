<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'period_id',
    ];

    public function activities()
    {
        return $this->belongsToMany('App\Activity')->withPivot('id', 'observation');
    }

    public function period()
    {
        return $this->belongsTo('App\Period');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function advisers()
    {
        return $this->hasMany('App\Adviser');
    }

}
