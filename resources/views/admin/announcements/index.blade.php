@extends('layouts.admin')

@section('title','Announcements Page')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Announcements</h4>

        <a href="{{ route('admin.announcements.create') }}"
            class="btn btn-primary">
            Add Announcement
        </a>
    </div>


    @if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    @endif


    <div class="card">

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($announcements as $row)

                    <tr>

                        <td>{{ $row->id }}</td>

                        <td>{{ $row->title }}</td>

                        <td>{{ $row->announcement_date }}</td>

                        <td>

                            @if($row->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                            @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.announcements.edit',$row->id) }}"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>


                            <form action="{{ route('admin.announcements.destroy',$row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No records found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="mt-3">

        {{ $announcements->links() }}

    </div>


</div>

@endsection