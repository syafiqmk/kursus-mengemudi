@extends('layouts.dashboard')

@section('content')
    <h3>{{ $course->package->name }}</h3>
    <p>{{ $course->package->detail }}</p>

    <h5>Instructor</h5>
    <div class="row d-flex justify-content-center mb-3">
        <div class="col-md-2">
            <img src="{{ asset('storage/'. $course->instructor->photo) }}" alt="" class="img-fluid" width="100%">
        </div>
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $course->instructor->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $course->instructor->email }}</td>
                </tr>
            </table>
        </div>
    </div>

    <h5>Car</h5>
    <div class="row d-flex justify-content-center mb-3">
        <div class="col-md-3">
            <img src="{{ asset('storage/'. $course->car->image) }}" alt="" class="img-fluid">
        </div>
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <td>Registration Number</td>
                    <td>:</td>
                    <td>{{ $course->car->registration_number }}</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td>{{ $course->car->brand->name }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $course->car->name }}</td>
                </tr>
                <tr>
                    <td>Engine Capacity</td>
                    <td>:</td>
                    <td>{{ $course->car->engine_capacity }} CC</td>
                </tr>
                <tr>
                    <td>Transmission</td>
                    <td>:</td>
                    <td>{{ $course->car->transmission->name }}</td>
                </tr>
            </table>
        </div>
    </div>

    <h5>Course Detail</h5>
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