<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salarie extends Model
{
    public function teacher(){
        return $this->belongsTo(salarie::class , 'teacher_id');
    }
}
