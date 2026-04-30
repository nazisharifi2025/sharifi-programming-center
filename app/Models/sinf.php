<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sinf extends Model
{
    public function teacher(){
        return $this->belongsTo(sinf::class , 'teacher_id');
    }
    public function payment(){
        return $this->hasMany(payment::class , 'sinf_id');
    }
}
