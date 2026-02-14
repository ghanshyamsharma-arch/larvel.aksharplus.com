@extends('layouts.admin')
@section('title', 'Hero Banner')

@section('content')
<div class="container">

<h2>Add Hero</h2>

<form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Tagline</label>

<input type="text" name="tagline" class="form-control">

</div>


<div class="mb-3">

<label>Title</label>

<input type="text" name="title" class="form-control">

</div>


<div class="mb-3">

<label>Highlight Text</label>

<input type="text" name="highlight_text" class="form-control">

</div>


<div class="mb-3">

<label>Description</label>

<textarea name="description" class="form-control"></textarea>

</div>


<div class="mb-3">

<label>Button Text</label>

<input type="text" name="button_text" class="form-control">

</div>


<div class="mb-3">

<label>Button Link</label>

<input type="text" name="button_link" class="form-control">

</div>


<div class="mb-3">

<label>Image</label>

<input type="file" name="image" class="form-control">

</div>


<button class="btn btn-primary">

Save

</button>


</form>

</div>

@endsection
