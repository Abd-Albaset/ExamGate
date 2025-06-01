<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



class QuestionController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        return Question::all();
    }

    public function show(Question $question) {
       return $question;
    }



    public function store(StoreQuestionRequest $request) {

        $attributes = [
            'subject_id' => $request->input('subject_id'),
            'text'       => $request->input('text'),
            'img'        => $request->input('img'),
        ];

        if($request->hasFile('img')){
            $path = saveImg($request->file('img') ,'QuestionImg');
            $attributes['img'] = $path;
        }

        return Question::create($attributes);
    }

    public function update(UpdateQuestionRequest $request ,Question $question) {
        $attributes = [
            'subject_id' => $request->input('subject_id'),
            'text'       => $request->input('text'),
            'img'        => $request->input('img'),
        ];

        if($request->hasFile('img')){
            $oldImgPath = $question->img;

            $path = saveImg($request->file('img') ,'QuestionImg');
            $attributes['img'] = $path;

            if($oldImgPath)
                Storage::delete($oldImgPath);
        }

        $question->update($attributes);
        return $question;
    }

    public function destroy(Question $question) {
        $deleted = $question;
        $question->delete();
        return $deleted;
    }
}
