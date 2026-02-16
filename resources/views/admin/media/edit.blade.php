@extends('layouts.admin')

@section('content')
<form method="POST"
    action="{{ route('admin.media.update', $media->id) }}"


    enctype="multipart/form-data">

    @csrf
    @method('PUT')


    Title

    <input type="text"
        name="title"
        value="{{ $media->title }}"
        class="form-control mb-3">
    Size

    <input type="text"
        name="size"
        value="{{ $media->size }}"
        class="form-control mb-3">



    File

    <input type="file"
        name="file"
        class="form-control mb-3">


    @if($media->file)

    <img src="{{ asset('storage/'.$media->file) }}"
        width="100">

    @endif



    Thumbnail

    <input type="file"
        name="thumbnail"
        class="form-control mb-3">


    @if($media->thumbnail)

    <img src="{{ asset('storage/'.$media->thumbnail) }}"
        width="100">

    @endif



    Link

    <input type="text"
        name="link"
        value="{{ $media->link }}"
        class="form-control mb-3">



    <button class="btn btn-primary">

        Update

    </button>


</form>

@endsection