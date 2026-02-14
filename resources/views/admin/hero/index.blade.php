@extends('layouts.admin')
@section('title', 'Hero Banner')

@section('content')

<div class="container">

<h2>Hero Section List</h2>

<a href="{{ route('admin.hero.create') }}" class="btn btn-primary" style=" float: right;
">Add Hero</a>

<table class="table mt-3">

<tr>

<th>ID</th>
<th>Title</th>
<th>Image</th>
<th>Action</th>

</tr>

@foreach($data as $row)

<tr>

<td>{{ $row->id }}</td>

<td>{{ $row->title }}</td>

<td>

<img src="{{ asset('storage/'.$row->image) }}" width="100">

</td>

<td>

<a href="{{ route('admin.hero.edit',$row->id) }}" class="btn btn-warning">Edit</a>


<form action="{{ route('admin.hero.destroy',$row->id) }}" method="POST" style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">
    Delete
</button>


</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection
