@extends('layouts.dashboard')

@section('content')
    <table class="table">
        <tr>
            <td>Package</td>
            <td>:</td>
            <td>{{ $course->package->name }}</td>
        </tr>
        <tr>
            <td>Student</td>
            <td>:</td>
            <td>{{ $course->student->name }}</td>
        </tr>
        <tr>
            <td>Instructor</td>
            <td>:</td>
            <td>{{ $course->instructor->name }}</td>
        </tr>
        <tr>
            <td>Car</td>
            <td>:</td>
            <td>{{ $course->car->brand->name }} {{ $course->car->name }}, {{ $course->car->transmission->name }}, {{ $course->car->engine_capacity }} CC ({{ $course->car->registration_number }})</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <form action="{{ route('instructor.finish', $course->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn-primary" onclick="return confirm('Finish Course?')">Finish</button>
                </form>
            </td>
        </tr>
    </table>

    <h3>Detail</h3>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="{{ route('instructor.addDetail', $course->id) }}" method="post">
                @csrf
                <div class="col-md mb-3 input-group">
                    <input type="text" class="form-control" name="detail" id="" placeholder="Course Detail" autocomplete="off" required>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Detail</th>
            <th>Date</th>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->detail }}</td>
                    <td>{{ date('l, d M Y', strtotime($detail->created_at)) }} ({{ $detail->created_at->diffForHumans() }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection