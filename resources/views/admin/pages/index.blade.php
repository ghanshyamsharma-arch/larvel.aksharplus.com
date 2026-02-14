@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Pages</h2>


    <a href="{{ route('admin.pages.create') }}"
        class="btn btn-primary mb-3">

        Add Page

    </a>



    {{-- FILTER --}}

    <form method="GET">

        <div style="display:flex; gap:10px;">


            <input type="text"
                name="title"
                value="{{ request('title') }}"
                placeholder="Search Title"
                class="form-control">




            <select name="status"
                class="form-control">

                <option value="">All Status</option>

                <option value="1"
                    {{ request('status')=='1'?'selected':'' }}>
                    Active
                </option>


                <option value="0"
                    {{ request('status')=='0'?'selected':'' }}>
                    Inactive
                </option>

            </select>



            <button class="btn btn-info">

                Filter

            </button>


            <a href="{{ route('admin.pages.index') }}"
                class="btn btn-secondary">

                Reset

            </a>


        </div>

    </form>



    <br>



    {{-- TABLE --}}

    <table class="table table-bordered">

        <tr>

            <th>ID</th>

            <th>Image</th>

            <th>Title</th>

            <th>Status</th>

            <th>Action</th>

        </tr>



        @foreach($pages as $page)

        <tr>

            <td>

                {{ $page->id }}

            </td>



            <td>

                @if($page->image)

                <img src="{{ asset('storage/'.$page->image) }}"
                    width="80">

                @endif

            </td>



            <td>

                {{ $page->title }}

            </td>



            <td>

                @if($page->status)

                <span style="color:green">

                    Active

                </span>

                @else

                <span style="color:red">

                    Inactive

                </span>

                @endif

            </td>



            <td>


                <a href="{{ route('admin.pages.edit',$page->id) }}"
                    class="btn btn-warning btn-sm">

                    Edit

                </a>



                <form action="{{ route('admin.pages.destroy',$page->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf

                    @method('DELETE')


                    <button class="btn btn-danger btn-sm"

                        onclick="return confirm('Delete?')">

                        Delete

                    </button>


                </form>



            </td>


        </tr>

        @endforeach


    </table>



    {{-- PAGINATION --}}

    {{ $pages->links() }}



</div>


@endsection