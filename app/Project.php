<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    // protected $guarded = [];
    protected $fillable = ['project_name','project_description','planned_start_date','planned_end_date','actual_start_date','actual_end_date'];
}
