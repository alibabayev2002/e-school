<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $table = "mark";
    public function student(){
        return $this->belongsTo('App\Models\Students', 'student_id','id');
    }
    public function subject(){
        return $this->belongsTo('App\Models\Subject', 'subject_id','id');
    }
}
