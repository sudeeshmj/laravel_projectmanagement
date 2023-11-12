<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'task_id', 'hours', 'taskdate', 'description',];


    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function task(){
        return $this->belongsTo(Task::class,'task_id','id');
    }

    public function setTaskdateAttribute($value){
        $this->attributes['taskdate'] = date('Y-m-d', strtotime($value));
    }
    public function getTaskdateAttribute($value){
        return date('d/m/Y', strtotime($value));
    }
}
