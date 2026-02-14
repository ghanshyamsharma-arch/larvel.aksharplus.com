@extends('layouts.admin')

@section('title','Edit Service')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h4>Edit Service</h4>

</div>


<div class="card-body">


<form method="POST"
action="{{ route('admin.services.update',$service->id) }}"
enctype="multipart/form-data">

@csrf

@method('PUT')


<div class="mb-3">

<label>Name</label>

<input type="text"
name="name"
value="{{ $service->name }}"
class="form-control">

</div>



<div class="mb-3">

<label>Description</label>

<textarea name="description"
class="form-control">{{ $service->description }}</textarea>

</div>



<div class="mb-3">

<label>File</label>

<input type="file"
name="file"
class="form-control">

<br>

<a href="{{ asset('storage/'.$service->file) }}"
target="_blank">

View Current File

</a>

</div>



<div class="mb-3">

<label>Status</label>

<select name="status"
class="form-control">

<option value="active"
{{ $service->status=='active'?'selected':'' }}>
Active
</option>

<option value="inactive"
{{ $service->status=='inactive'?'selected':'' }}>
Inactive
</option>

</select>

</div>

<br>

<button class="btn btn-primary">

Update Service

</button>


<a href="{{ route('admin.services.index') }}"
class="btn btn-secondary">

Back

</a>


</form>


</div>


</div>


</div>


@endsection
