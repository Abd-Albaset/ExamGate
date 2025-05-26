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
        $attributes = [
            'college_id' => $request->input('college_id'),
            'name'       => $request->input('name'),
            'year'       => $request->input('year'),
            'specialize' => $request->input('specialize'),
            'semester'   => $request->input('semester')
        ];

        return Subject::create($attributes);

    }

    public function update(UpdateSubjectRequest $request,Subject $subject) {
        $attributes = [
            'name'       => $request->input('name'),
            'college_id' => $request->input('college_id'),
            'year'       => $request->input('year'),
            'specialize' => $request->input('specialize'),
            'semester'   => $request->input('semester')
        ];

        $subject->update($attributes);

        return response()->json($subject);
    }

    public function destroy(Subject $subject) {
        $subject->delete();
    }

}
