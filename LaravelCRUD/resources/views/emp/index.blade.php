<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Emp Details</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Emp Details</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('emp.create') }}"> Create Emp</a>
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
<th>Emp Name</th>
<th>Emp Mobile</th>
<th>Emp Email</th>
<th width="280px">Action</th>
</tr>
@foreach ($emp as $e)
<tr>
<td>{{ $e->id }}</td>
<td>{{ $e->emp_name }}</td>
<td>{{ $e->emp_mobile }}</td>
<td>{{ $e->emp_email }}</td>
<td>
<form action="{{ route('emp.destroy',$e->id) }}" method="Post">
<a class="btn btn-primary" href="{{ route('emp.edit',$e->id) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
{!! $emp->links() !!}
</body>
</html>