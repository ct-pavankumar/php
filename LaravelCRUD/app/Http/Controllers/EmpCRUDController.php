<?php
namespace App\Http\Controllers;
use App\Models\Emp;
use Illuminate\Http\Request;
class EmpCRUDController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['emp'] = Emp::orderBy('id','desc')->paginate(5);
return view('emp.index', $data);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('emp.create');
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
'emp_name' => 'required',
'emp_mobile' => 'required',
'emp_email' => 'required'
]);
$emp = new Emp;
$emp->emp_name = $request->emp_name;
$emp->emp_mobile = $request->emp_mobile;
$emp->emp_email = $request->emp_email;
$emp->save();
return redirect()->route('emp.index')
->with('success','Emp has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\Emp  $emp
* @return \Illuminate\Http\Response
*/
public function show(Emp $emp)
{
return view('emp.show',compact('emp'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Emp  $emp
* @return \Illuminate\Http\Response
*/
public function edit(Emp $emp)
{
return view('emp.edit',compact('emp'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\Emp  $emp
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'emp_name' => 'required',
'emp_mobile' => 'required',
'emp_email' => 'required',
]);
$emp = Emp::find($id);
$emp->emp_name = $request->emp_name;
$emp->emp_mobile = $request->emp_mobile;
$emp->emp_email = $request->emp_email;
$emp->save();
return redirect()->route('emp.index')
->with('success','Emp Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Emp  $emp
* @return \Illuminate\Http\Response
*/
public function destroy(Emp $emp)
{
$emp->delete();
return redirect()->route('emp.index')
->with('success','Emp has been deleted successfully');
}
}