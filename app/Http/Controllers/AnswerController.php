<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use Illuminate\Support\Facades\Storage;
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

    public function store(CreateAnswerRequest $request){
        $attributes = [
            'question_id' => $request->input('question_id'),
            'text'        => $request->input('text'),
            'img'         => $request->input('img'),
            'IsCorrect'   => $request->input('IsCorrect'),
        ];

        if($request->hasFile('img')){
            $path = saveImg($request->file('img') ,'answers_Img');
            $attributes['img'] = $path;
        }
        return Answer::create($attributes);
    }

    public function update(UpdateAnswerRequest $request, Answer $answer){
        $attributes = [
            'question_id' => $request->input('question_id'),
            'text'        => $request->input('text'),
            'img'         => $request->input('img'),
            'IsCorrect'   => $request->input('IsCorrect'),
        ];

        if($request->hasFile('img')){
            $oldImgPath = $answer->img;

            $path = saveImg($request->file('img') ,'answers_Img');
            $attributes['img'] = $path;

            if($oldImgPath)
                Storage::delete($oldImgPath);
        }


        $answer->update($attributes);

        return $answer;
    }

    public function destroy(Answer $answer){
        $temp = $answer;
        $answer->delete();

        $oldImgPath = $answer->img;
        if($oldImgPath)
            Storage::delete($oldImgPath);

        return $temp;
    }
}
