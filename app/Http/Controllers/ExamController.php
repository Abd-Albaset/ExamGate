<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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
                ->where('session', $session);
        })
            ->where('IsCorrect', true)
            ->pluck('label');

        // Validate user answers
        if (!$this->validateUserAnswers($request)) {
            return response()->json('A label must be in [A, B, C, D, E]', 400);
        }

        // Normalize user answers (fill missing answers with 'X')
        $userAnswers = $this->normalizeUserAnswers($request, $rightAnswers);

        // Calculate marks and identify mistakes
        $result = $this->calculateMarks($rightAnswers, $userAnswers);

        // Return the result
        return response()->json([
            "marks" => $result['marks'],
            "mistakes" => $result['mistakes'],
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

        return $userAnswers;
    }

    /**
     * Calculate marks and identify mistakes.
     */
    private function calculateMarks($rightAnswers, $userAnswers)
    {
        $marks = 0;
        $mistakes = [];

        foreach ($rightAnswers as $index => $ra) {
            if ($ra == $userAnswers[$index + 1]) {
                $marks++;
            } else {
                $mistakes[$index + 1] = $ra;
            }
        }

        $marks = ceil(($marks / count($rightAnswers)) * 100);

        return [
            'marks' => $marks,
            'mistakes' => $mistakes,
        ];
    }

}


