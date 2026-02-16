@extends('layouts.admin')

@section('title','Media List')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>Media List</h4>

            <a href="{{ route('admin.media.create') }}" style="float: right;"
                class="btn btn-primary mb-3">

                Add Media

            </a>

        </div>


        <div class="card-body">


            <form class="mb-3">

                <select name="type" onchange="this.form.submit()"
                    class="form-control w-25">

                    <option value="">Filter</option>

                    <option value="image">Image</option>

                    <option value="video">Video</option>

                    <option value="audio">Audio</option>

                    <option value="document">Document</option>

                </select>

            </form>



            <table class="table table-bordered">

                <tr>

                    <th>ID</th>

                    <th>Title</th>

                    <th>Type</th>

                    <th>Preview</th>

                    <th>Action</th>

                </tr>


                @foreach($media as $item)

                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->title }}</td>

                    <td>{{ $item->type }}</td>

                    <td>

                        @if($item->file)

                        <img src="{{ asset('storage/'.$item->file) }}"
                            width="60">

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('admin.media.edit',$item->id) }}"
                            class="btn btn-sm btn-warning">

                            Edit

                        </a>


                        <form method="POST"
                            action="{{ route('admin.media.destroy',$item->id) }}"
                            style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this media?')">

                                Delete

                            </button>

                        </form>


                    </td>

                </tr>

                @endforeach


            </table>


            {{ $media->links() }}


        </div>
    </div>
</div>

@endsection