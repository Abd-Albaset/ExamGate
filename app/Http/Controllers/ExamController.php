<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index(){
        // get the subjects that's have questions in database
        return Subject::whereHas("questions")->get();
    }


    public function getExamData(Subject $subject, $session) {
        return Question::where('subject_id', $subject->id)
                            ->where('session', $session)
                            ->with('answers')->get();
    }

    public function marksEvaluate(Request $request, Subject $subject, $session){
     /*   $rightAnswers = Question::where('subject_id', $subject->id)
                            ->where('session', $session)
                            ->with('answers', fn($query)=> $query->where('IsCorrect', true) )->get();*/

        $rightAnswers = DB::table('questions')
            ->join('answers','questions.id', '=', 'answers.question_id')
            ->select('answers.label')
            ->where('questions.subject_id', $subject->id)
            ->where('questions.session', $session)
            ->where('answers.IsCorrect', true)
            ->get()->pluck('label');

        // validate all labels to be in [A,B,C,D,E] using regex
        $labelValidation = array_map(fn($label) => preg_match("/^[ABCDEX]$/",$label) , $request->toArray());

        if(in_array(0,$labelValidation))
            return response()->json('a label must be in [A,B,C,D,E]');

        $userAnswers = $request->toArray();

        if(count($userAnswers) < count($rightAnswers )){
            for($i = count($userAnswers) + 1; $i <= count($rightAnswers) ; $i++) {
                $userAnswers[$i] = "X";
            }
        }

        $marks = 0;
        $mistakes = [];

        foreach ($rightAnswers as $ra){
            static $i = 1;
            if($ra == $userAnswers[$i]){
               $marks++;
            }
            else{
                $mistakes[$i] = $ra;
            }
            $i++;
        }
        // total mark = number of user's right answers / number of all answer * 100
        $marks = ceil(( $marks / count($rightAnswers) ) * 100) ;

        return response()->json([
            "marks = $marks",
            "your mistakes was:",
            $mistakes
        ]);
    }
}


