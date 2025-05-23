<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
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

        $questionData = $this->prepareQuestionData($request);

        $answers = $this->validateAnswers($request);

        $question = $this->saveQuestionAndAnswers($questionData, $answers, $request);

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

    private function prepareQuestionData(StoreQuestionRequest $request): array
    {
        $question = [
            'subject_id' => $request->input('subject_id'),
            'number'     => $request->input('number'),
            'session'    => $request->input('session'),
            'q-text'     => $request->input('q-text')
        ];

        if ($request->hasFile('q-img')) {
            $path = saveImg('q-img', 'questions_Img');
            $question['q-img'] = $path;
        }

        return $question;
    }

    private function validateAnswers(StoreQuestionRequest $request)
    {
        $answers = json_decode($request->input('answers'), true);

        if (Question::rightAnswersCount($answers) > 1) {
            throw new \Exception('A question cannot have more than one right answer.');
        }

        if (count($answers) > 5) {
            throw new \Exception('A question cannot have more than five answers.');
        }

        $labels = array_unique(array_map(fn($arr) => $arr['label'], $answers));
        if (count($labels) != count($answers)) {
            throw new \Exception('A label cannot be duplicated.');
        }

        return $answers;
    }

    private function saveQuestionAndAnswers(array $questionData, array $answers, StoreQuestionRequest $request): Question
    {
        $question = Question::create($questionData);

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

        return $question->load('answers'); // Load the 'answers' relationship
    }

}
