<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {

    }

    public function index() {
        return Subject::all();
    }

    public function show(Subject $subject){
        return $subject;
    }

    public function store(CreateSubjectRequest $request) {
        return Subject::create(
            ['name' => $request->input('name')]
        );
    }

    public function update(UpdateSubjectRequest $request,Subject $subject) {
        $subject->update(['name' => $request->input('name')]);

        return response()->json($subject);
    }

    public function destroy(Subject $subject) {
        $subject->delete();
    }

}
