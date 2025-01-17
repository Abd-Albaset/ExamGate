<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','role:instructor'], ['except' => ['index','show']]);
    }

    public function index() {
        return Subject::paginate(6);
        // return csrf_token();
    }

    public function show(Subject $subject){
        return $subject;
    }

    public function store() {
        $attributes = request()->validate([
            'name'       => 'required|unique:subjects,name|max:255|min:3',
            'college_id'    => 'required',
            'year'       => 'required',
            'specialize' => 'required',
            'semester'   => 'required'
        ]);

        return Subject::create($attributes);

    }

    public function update(Subject $subject) {
        $attributes = request()->validate([
            'name'       => ['required', Rule::unique('subjects', 'name')->ignore($subject) ],
            'college_id'    =>'required',
            'year'       => 'required',
            'specialize' => 'required',
            'semester'   => 'required'
        ]);

        $subject->update($attributes);

        return response()->json($subject);
    }

    public function destroy(Subject $subject) {
        $subject->delete();
    }

}
