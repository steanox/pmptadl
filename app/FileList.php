<?php

namespace Pmptadl;

use Illuminate\Database\Eloquent\Model;
use Pmptadl\Project;

class FileList extends Model
{
    protected $table = 'fileLists';

    public function projects()
    {
    	return $this->belongsToMany(Project::class, 'projectFileLists', 'fileListID', 'projectID');
    }
}
