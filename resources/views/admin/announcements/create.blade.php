@extends('admin.layout')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">

            <h4>Add Announcement</h4>

        </div>


        <div class="card-body">

            <form method="POST"
                action="{{ route('admin.announcements.store') }}">

                @csrf


                <div class="mb-3">

                    <label class="form-label">Title</label>

                    <input type="text"
                        name="title"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label class="form-label">Description</label>

                    <textarea name="description"
                        class="form-control"
                        rows="4"></textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">Date</label>

                    <input type="date"
                        name="announcement_date"
                        class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select name="status"
                        class="form-select">

                        <option value="1">Active</option>

                        <option value="0">Inactive</option>

                    </select>

                </div>


                <button class="btn btn-success">

                    Save

                </button>


                <a href="{{ route('admin.announcements.index') }}"
                    class="btn btn-secondary">

                    Back

                </a>


            </form>

        </div>

    </div>

</div>

@endsection