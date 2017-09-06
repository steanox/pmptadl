<?php

namespace Pmptadl;

use Illuminate\Database\Eloquent\Model;
use Pmptadl\Category;

class Project extends Model
{
	protected $primaryKey = 'project_id';

    public function category()
    {
    	return $this->belongsTo(Category::class, 'categoryID');
    }
}
