@extends('layouts.admin')
@section('title', 'Contact us')

@section('content')


<div class="container mt-5">

    <h2 class="mb-4">Admin Contact List</h2>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Message</th>

                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            @foreach($contacts as $contact)

            <tr>

                <td>{{ $contact->id }}</td>

                <td>{{ $contact->name }}</td>

                <td>{{ $contact->email }}</td>

                <td>{{ $contact->phone }}</td>

                <td>{{ $contact->message }}</td>

                <td>{{ $contact->created_at->format('d-m-Y') }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>


    <!-- Pagination -->

    <div>

        {{ $contacts->links() }}

    </div>


</div>
@endsection