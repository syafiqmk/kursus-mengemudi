@extends('layouts.dashboard')

@section('content')
    <table class="table">
        <thead>
            <th>#</th>
            <th>Course</th>
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
                        <a href="{{ route('instructor.historyDetail', $course->id) }}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection