<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        "lastName",
        "user_id",
        "img_url",
        "phone_number",
        "tazkira_no"
    ];
    public function user(){
        return $this->belongsTo(user::class , 'user_id');
    }
    public function sinfs(){
        return $this->belongsToMany(sinf::class , 'sinf_id');
    }
    public function payment(){
        return $this->hasMany(payment::class , 'student_id');
    }
}
