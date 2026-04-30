<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function salairy(){
        return $this->hasMany(salarie::class , 'teacher_id');
    }
    public function sinf(){
        return $this->hasMany(sinf::class , 'teacher_di');
    }
}
