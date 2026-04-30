<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    public function student(){
        return $this->belongsTo(Student::class , 'student_id');
    }
    public function sinf(){
        return $this->belongsTo(sinf::class , 'sinf_id');
    }
}
