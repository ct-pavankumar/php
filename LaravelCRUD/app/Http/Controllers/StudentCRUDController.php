<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
class StudentCRUDController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['students'] = Student::orderBy('id','desc')->paginate(5);
return view('students.index', $data);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('students.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'student_name' => 'required',
'roll_no' => 'required',
'student_class' => 'required'
]);
$Student = new Student;
$Student->student_name = $request->student_name;
$Student->roll_no = $request->roll_no;
$Student->student_class = $request->student_class;
$Student->save();
return redirect()->route('students.index')
->with('success','Student has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\Student  $Student
* @return \Illuminate\Http\Response
*/
public function show(Student $Student)
{
return view('students.show',compact('Student'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Student  $Student
* @return \Illuminate\Http\Response
*/
public function edit(Student $Student)
{
return view('students.edit',compact('Student'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\Student  $Student
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',
'email' => 'required',
'address' => 'required',
]);
$Student = Student::find($id);
$Student->student_name = $request->student_name;
$Student->roll_no = $request->roll_no;
$Student->student_class = $request->student_class;
$Student->save();
return redirect()->route('students.index')
->with('success','Student Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Student  $Student
* @return \Illuminate\Http\Response
*/
public function destroy(Student $Student)
{
$Student->delete();
return redirect()->route('students.index')
->with('success','Student has been deleted successfully');
}
}