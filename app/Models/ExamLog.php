<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function userExamLogs()
    {
        return $this->hasMany(UserExamLog::class);
    }

}
