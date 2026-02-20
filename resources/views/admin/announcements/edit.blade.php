@extends('layouts.admin')

@section('title','Announcements Edit')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">

            <h4>Edit Announcement</h4>

        </div>


        <div class="card-body">

            <form method="POST"
                action="{{ route('admin.announcements.update',$announcement->id) }}">

                @csrf
                @method('PUT')


                <div class="mb-3">

                    <label class="form-label">Title</label>

                    <input type="text"
                        name="title"
                        class="form-control"
                        value="{{ $announcement->title }}"
                        required>

                </div>


                <div class="mb-3">

                    <label class="form-label">Description</label>

                    <textarea name="description"
                        class="form-control"
                        rows="4">{{ $announcement->description }}</textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">Date</label>

                    <input type="date"
                        name="announcement_date"
                        class="form-control"
                        value="{{ $announcement->announcement_date }}">

                </div>


                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select name="status"
                        class="form-control">

                        <option value="1"
                            {{ $announcement->status ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ !$announcement->status ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                <button class="btn btn-primary">

                    Update

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