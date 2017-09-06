<?php

namespace Pmptadl;

use Illuminate\Database\Eloquent\Model;
use Pmptadl\User;

class Minute extends Model
{
    protected $table = 'minutes';

    public function remark()
    {
    	return $this->belongsTo(User::class, 'remarkID');
    }

    public function todos()
    {
    	return $this->hasMany(Todo::class, 'minuteID');
    }

    public function users()
    {
    	return $this->belongsToMany(User::class, 'minuteUsers', 'minuteID', 'userID');
    }
}
