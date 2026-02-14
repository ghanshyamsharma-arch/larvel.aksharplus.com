@extends('layouts.admin')

@section('title', 'Services')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="card-title mb-0">
                Services
            </h4>

            <a href="{{ route('admin.services.create') }}" style="float: right;"
               class="btn btn-primary">

                Add Service

            </a>

        </div>



        <div class="card-body">


            {{-- FILTER --}}

            <form method="GET" class="row mb-3">

                <div class="col-md-3">

                    <input type="text"
                           name="name"
                           value="{{ request('name') }}"
                           class="form-control"
                           placeholder="Search Name">

                </div>


                <div class="col-md-3">

                    <select name="status"
                            class="form-control">

                        <option value="">
                            All Status
                        </option>

                        <option value="active"
                        {{ request('status')=='active'?'selected':'' }}>
                            Active
                        </option>

                        <option value="inactive"
                        {{ request('status')=='inactive'?'selected':'' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="col-md-2">

                    <button class="btn btn-success">
                        Filter
                    </button>

                </div>


            </form>



            {{-- TABLE --}}

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Name</th>

                            <th>Description</th>

                            <th>File</th>

                            <th>Status</th>

                            <th width="150">
                                Action
                            </th>

                        </tr>

                    </thead>



                    <tbody>

                        @forelse($services as $service)

                        <tr>

                            <td>
                                {{ $service->id }}
                            </td>


                            <td>
                                {{ $service->name }}
                            </td>


                            <td>
                                {{ $service->description }}
                            </td>


                            <td>

                                <a href="{{ asset('storage/'.$service->file) }}"
                                   class="btn btn-sm btn-info"
                                   target="_blank">

                                   View

                                </a>

                            </td>


                            <td>

                                @if($service->status=='active')

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


                                <a href="{{ route('admin.services.edit',$service->id) }}"
                                   class="btn btn-sm btn-warning">

                                    Edit

                                </a>



                                <form action="{{ route('admin.services.destroy',$service->id) }}"
                                      method="POST"
                                      style="display:inline;">

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

                            <td colspan="6"
                            class="text-center">

                            No Data Found

                            </td>

                        </tr>

                        @endforelse


                    </tbody>

                </table>


            </div>



            {{-- PAGINATION --}}

            <div class="mt-3">

                {{ $services->links() }}

            </div>



        </div>


    </div>


</div>


@endsection
