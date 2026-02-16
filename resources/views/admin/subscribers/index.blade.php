@extends('layouts.admin')

@section('title','Subscribe')
@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Subscribers</h4>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th>ID</th>

                    <th>Email</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>


                @foreach($subscribers as $sub)

                <tr>

                    <td>{{ $sub->id }}</td>

                    <td>{{ $sub->email }}</td>

                    <td>{{ $sub->created_at->format('d M Y') }}</td>

                    <td>

                        <form method="POST"
                            action="{{ route('admin.subscribers.delete',$sub->id) }}">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure wants to delete ?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </table>


            {{ $subscribers->links() }}


        </div>

    </div>

</div>

@endsection