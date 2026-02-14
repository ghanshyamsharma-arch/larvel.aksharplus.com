@extends('layouts.admin')

@section('title','Add Service')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h4>Add Service</h4>

</div>


<div class="card-body">


<form method="POST"
action="{{ route('admin.services.store') }}"
enctype="multipart/form-data">

@csrf


<div class="mb-3">

<label class="form-label">
Name
</label>

<input type="text"
name="name"
class="form-control"
required>

</div>



<div class="mb-3">

<label class="form-label">
Description
</label>

<textarea name="description"
class="form-control">
</textarea>

</div>



<div class="mb-3">

<label class="form-label">
File
</label>

<input type="file"
name="file"
class="form-control"
required>

</div>



<div class="mb-3">

<label class="form-label">
Status
</label>

<select name="status"
class="form-control">

<option value="active">
Active
</option>

<option value="inactive">
Inactive
</option>

</select>

</div>


<br>
<button class="btn btn-primary">

Save Service

</button>


<a href="{{ route('admin.services.index') }}"
class="btn btn-pr">

Back

</a>



</form>


</div>


</div>


</div>


@endsection
