<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\map;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','role:instructor'], ['except' => ['index','show']]);
    }

    public function index() {
        return Question::all();
    }

    public function show(Question $question) {
       return $question;
    }

    public function store(StoreQuestionRequest $request) {
        $question = [
            'subject_id' => $request->input('subject_id'),
            'number'     => $request->input('number'),
            'session'    => $request->input('session'),
            'q-text'     => $request->input('q-text')
        ];

        $answers = json_decode($request->input('answers'), true) ;
//        if(json_last_error() === JSON_ERROR_NONE){
//            var_dump($answers);
//        }else{
//            echo "err" . json_last_error();
//        }
        if(Question::rightAnswersCount($answers) > 1)
            return response()->json('a question can not has more than one right answer');

        if(count($answers) > 5)
            return response()->json('a question can not has more than five answer');

        $labels = array_unique(array_map(fn($arr) => $arr['label'], $answers));

        if (count($labels) != count($answers))
            return response()->json('a label can not be dublicated');

        if($request->hasFile('q-img')){
            $path = saveImg('q-img','questions_Img');
            $question['q-img'] = $path;
        }

        $question = Question::create($question);

        foreach ($answers as $answer){
            // send A-img in request for answer A image and so on
            if($request->hasFile($answer['label'] . '-img') ){
                $path = saveImg($answer['label']. '-img','answers_Img');
                $answer['a-img'] = $path;
                // ASCII value of A is 65 so it will result as 0 for A as it is first array element and so on
                $answers[ord($answer['label']) - 65] ['a-img'] = $path;
            }
        }

        $question->answers()->createMany($answers);

        $question->answers;  // to load the 'answers' relations to '$question' object
        return $question;
    }

    public function update(Question $question) {
        $attributes = request()->validate([
            'subject_id' => ['required', Rule::exists("subjects", 'id')],
            'number'     => 'required',
            'session'    => 'required',
            'q-text'     => 'required',
            'q-img'     => 'image'
        ]);

        if(isset($attributes['q-img'])){
            $path = saveImg('q-img','questions_Img');
            $attributes['q-img'] = $path;
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
