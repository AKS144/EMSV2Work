<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectManager extends Model
{
    protected $table = 'project_managers';
    protected $fillable = ['project_id','user_id'];
}
