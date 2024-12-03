<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public static function rightAnswersCount(array $answers){
        foreach($answers as $answer){
            static $counter = 0 ;
            $counter += $answer['IsCorrect'];
        }
        return $counter;
    }

}

