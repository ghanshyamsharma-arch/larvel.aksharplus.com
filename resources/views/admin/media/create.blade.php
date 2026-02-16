@extends('layouts.admin')

@section('title','Add Media')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Add Media

        </div>

        <div class="card-body">


            <form method="POST"
                action="{{ route('admin.media.store') }}"
                enctype="multipart/form-data">

                @csrf


                Title

                <input type="text"
                    name="title"
                    class="form-control mb-3">
                Size

                <input type="text"
                    name="size"
                    class="form-control mb-3">



                Type

                <select name="type"
                    class="form-control mb-3">

                    <option value="image">Image</option>

                    <option value="video">Video</option>

                    <option value="audio">Audio</option>

                    <option value="document">Document</option>

                    <option value="link">Link</option>

                </select>



                File

                <input type="file"
                    name="file"
                    class="form-control mb-3">



                Thumbnail

                <input type="file"
                    name="thumbnail"
                    class="form-control mb-3">



                Link

                <input type="text"
                    name="link"
                    class="form-control mb-3">



                <button class="btn btn-success">

                    Save

                </button>


            </form>


        </div>
    </div>
</div>

@endsection