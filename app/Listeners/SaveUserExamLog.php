<?php

namespace App\Listeners;

use App\Events\UserAnsweredIncorrectly;
use App\Models\ExamLog;
use App\Models\Question;
use App\Models\UserExamLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveUserExamLog implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAnsweredIncorrectly $event): void
    {
        // Fetch all question IDs for the subject and session
        $questionsId = Question::where('subject_id', $event->subjectId)
            ->where('session', $event->session)
            ->pluck('id');

        // send auth->id, subject->id, session to ExamLog table
        $examLog = ExamLog::create([
            'user_id' => auth()->id(),
            'subject_id' => $event->subjectId,
            'session' => $event->session
        ]);

        // Save the new incorrect question IDs
        foreach ($event->incorrectQuestionIds as $questionId) {
            UserExamLog::create([
                'exam_log_id' => $examLog->id,
                'question_id' => $questionId,
            ]);
        }
    }
}
