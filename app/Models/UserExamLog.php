<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExamLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function examLog()
    {
        return $this->belongsTo(ExamLog::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }


}
