<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    function department(){
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    function course(){
        return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }
}
