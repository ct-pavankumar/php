<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Students</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('students.create') }}"> Create student</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>Student Name</th>
<th>Student Roll Number</th>
<th>Student Class</th>
<th width="280px">Action</th>
</tr>
@foreach ($students as $student)
<tr>
<td>{{ $student->id }}</td>
<td>{{ $student->student_name }}</td>
<td>{{ $student->roll_no }}</td>
<td>{{ $student->student_class }}</td>
<td>
<form action="{{ route('students.destroy',$student->id) }}" method="Post">
<a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
{!! $students->links() !!}
</body>
</html>