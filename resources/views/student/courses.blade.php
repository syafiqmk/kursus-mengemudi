@extends('layouts.dashboard')

@section('content')

    <table class="table">
        <thead>
            <th>#</th>
            <th>Package</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->package->name }}</td>
                    <td>
                        @if ($course->status == 'enroll')
                            <a href="{{ route('student.pay', $course->id) }}" class="btn btn-success">Enroll (Click to Pay!)</a>
                        @elseif($course->status == 'wait')
                            <p class="btn btn-warning">Waiting for Payment Confirmation</p>
                        @elseif($course->status == 'grant')
                            <div class="btn-group">
                                <span class="btn btn-primary">On Going</span>
                                <a href="{{ route('student.courseDetail', $course->id) }}" class="btn btn-success">Detail</a>
                            </div>
                            @elseif($course->status == 'finish')
                            <div class="btn-group">
                                <span class="btn btn-primary">Finished</span>
                                <a href="{{ route('student.courseDetail', $course->id) }}" class="btn btn-success">Detail</a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection