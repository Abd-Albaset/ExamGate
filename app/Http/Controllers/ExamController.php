<?php

namespace App\Http\Controllers;

use App\Events\UserAnsweredIncorrectly;
use App\Models\Answer;
use App\Models\ExamLog;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

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

    public function marksEvaluate(Request $request, Subject $subject, $session)
    {
        // Fetch correct answers
        $rightAnswers = Answer::whereHas('question', function ($query) use ($subject, $session) {
            $query->where('subject_id', $subject->id)
                ->where('session', $session);})
            ->where('IsCorrect', true)
            ->get();

        if (!$this->validateUserAnswers($request)) {
            return response()->json('A label must be in [A, B, C, D, E]', 400);
        }

        $rightAnswersLabels = $rightAnswers->pluck('label');

        $userAnswers = $this->normalizeUserAnswers($request, $rightAnswersLabels);

        $result = $this->calculateMarks($rightAnswers, $userAnswers);

        // Dispatch the event to save incorrect question IDs
        event(new UserAnsweredIncorrectly(
            auth()->id(),
            $subject->id,
            $session,
            $result['incorrectQuestionIds']
        ));

        return response()->json([
            "marks" => $result['marks'],
            "mistakes" => $result['mistakes'],
            "incorrectQuestionIds" =>$result['incorrectQuestionIds'],
        ]);
    }

    /**
     * Validate user answers to ensure they are in [A, B, C, D, E].
     */
    private function validateUserAnswers(Request $request)
    {
        $labelValidation = array_map(
            fn($label) => preg_match("/^[ABCDEX]$/", $label),
            $request->toArray()
        );

        return !in_array(0, $labelValidation);
    }

    /**
     * Normalize user answers by filling missing answers with 'X'.
     */
    private function normalizeUserAnswers(Request $request, $rightAnswers)
    {
        $userAnswers = $request->toArray();


        // Ensure the userAnswers array has the same length as rightAnswers
        for ($i = 1; $i <= count($rightAnswers); $i++) {
            if (!isset($userAnswers[$i])) {
                $userAnswers[$i] = "X"; // Fill missing answers with 'X'
            }
        }

        // Sort the array by keys to ensure the answers are in the correct order
        ksort($userAnswers);


//        for ($j = 0 ; ($j < count($rightAnswers) - count($userAnswers)) ; $j++) {
//            array_pop($userAnswers);
//        }

        return $userAnswers;
    }

    /**
     * Calculate marks and identify mistakes.
     */
    private function calculateMarks($rightAnswers, $userAnswers)
    {
        $marks = 0;
        $mistakes = [];
        $incorrectQuestionIds = []; // Array to store IDs of incorrectly answered questions

        foreach ($rightAnswers->pluck('label') as $index => $ra) {
            if ($ra == $userAnswers[$index + 1]) {
                $marks++;
            } else {
                $mistakes[$index + 1] = $ra;
                $incorrectQuestionIds[] = $rightAnswers[$index]->question_id;  // 0 based array $rightAnswers
            }

        }

        $marks = ceil(($marks / count($rightAnswers)) * 100);

        return [
            'marks' => $marks,
            'mistakes' => $mistakes,
            'incorrectQuestionIds' => $incorrectQuestionIds, // IDs of incorrectly answered questions
        ];
    }

}


