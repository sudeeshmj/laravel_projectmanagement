<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function getStatusAttribute($value){
        return  $value == 1 ? 'Active':  'Inactive';
    }
}
