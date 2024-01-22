<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::with('academic','country')->get();
        return response()->json(['students' => $students]);
    }

    public function store(Request $request){
        $student = Student::create($request->all());
        $student -> profile()->create($request->input('academic','country'));
        return response()->json($student, 201);
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        $student -> profile()->update($request->input('academic','country'));
        return response()->json(['student'=>$student]);
    }

    public function destroy($id){
        $student = Student::find($id);
        $student -> update($request->all());
        $student -> profile()->delete();
        $student->delete();
        return response()->json(['student'=> $student]);
    }
}
