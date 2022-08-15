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
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->package->name }}</td>
                    <td>{{ $course->student->name }}</td>
                    <td>
                        <a href="{{ route('instructor.course', $course->id) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection