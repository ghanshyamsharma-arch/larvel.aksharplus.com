@extends('layouts.admin')
@section('title', 'Hero Banner')

@section('content')

<div class="container">

<h2>Edit Hero</h2>

<form method="POST" action="{{ route('admin.hero.update',$hero->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')


<input type="text" name="tagline" value="{{ $hero->tagline }}" class="form-control mb-3">


<input type="text" name="title" value="{{ $hero->title }}" class="form-control mb-3">


<input type="text" name="highlight_text" value="{{ $hero->highlight_text }}" class="form-control mb-3">


<textarea name="description" class="form-control mb-3">

{{ $hero->description }}

</textarea>


<input type="text" name="button_text" value="{{ $hero->button_text }}" class="form-control mb-3">


<input type="text" name="button_link" value="{{ $hero->button_link }}" class="form-control mb-3">


<img src="{{ asset('storage/'.$hero->image) }}" width="150">


<input type="file" name="image" class="form-control mb-3">


<button class="btn btn-primary">

Update

</button>


</form>

</div>

@endsection
