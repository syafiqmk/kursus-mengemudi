@extends('layouts.dashboard')

@section('content')

    <table class="table">
        <thead>
            <th>#</th>
            <th>Package</th>
            <th>Student</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($enrolls as $enroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $enroll->package->name }}</td>
                    <td>{{ $enroll->student->name }}</td>
                    <td>
                        <a href="/admin/enroll/{{ $enroll->id }}" class="btn btn-primary">Confirm</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection