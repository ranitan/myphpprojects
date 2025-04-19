<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class studentcontroller extends Controller
{
    public function viewform(){
        $students = student::all();
        return view('student-reg',compact('students'));
    }

    public function addstudent(Request $request){
        //dd($request->all());
        student::create($request->all());
        return redirect()->route('home')->with('message','student registered successfully!!!');
    }
}
