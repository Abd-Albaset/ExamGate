<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnswerController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        return Answer::all();
    }

    public function show(Answer $answer) {
        return $answer;
    }

    public function store(){
        $attributes = request()->validate([
            'question_id' => ['required', Rule::exists("questions", 'id')],
            'label'     => 'required|max:1',
            'a-text'    => 'required|max:255',
            'a-img'     => 'image',
            'IsCorrect' => 'required|boolean'
        ]);

        if(isset($attributes['a-img'])){
            $path = saveImg('a-img','answers_Img');
            $attributes['a-img'] = $path;
        }

        return Answer::create($attributes);
    }

    public function update(Answer $answer){
        $attributes = request()->validate([
            'question_id' => ['required', Rule::exists("questions", 'id')],
            'label'     => 'required|max:1',
            'a-text'    => 'required|max:255',
            'a-img'     => 'image',
            'IsCorrect' => 'required'
        ]);

        if(isset($attributes['a-img'])){
            $path = saveImg('a-img','answers_Img');
            $attributes['a-img'] = $path;
        }

        $answer->update($attributes);

        return $answer;
    }

    public function destroy(Answer $answer){
        $temp = $answer;
        $answer->delete();
        return $temp;
    }
}
