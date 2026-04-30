<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user(){
        return $this->belongsTo(user::class , 'user_id');
    }
    public function payment(){
        return $this->hasMany(payment::class , 'student_id');
    }
}
