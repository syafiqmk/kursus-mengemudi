@extends('layouts.dashboard')

@section('content')
    <div class="image d-flex justify-content-center mb-3">
        <img src="{{ asset('/storage/' . $enroll->payment_image) }}" alt="" class="img-fluid col-sm-5">
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <table class="table">
                <tr>
                    <td>Student</td>
                    <td>:</td>
                    <td>{{ $enroll->student->name }}</td>
                </tr>
                <tr>
                    <td>Package</td>
                    <td>:</td>
                    <td>{{ $enroll->package->name }}</td>
                </tr>
                <tr>
                    <td>Package Price</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($enroll->package->price, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Car</td>
                    <td>:</td>
                    <td>{{ $enroll->car->name }} ({{ $enroll->car->registration_number }})</td>
                </tr>
                <tr>
                    <td>Car Rent Price</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($enroll->car->price, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td>Rp. {{ number_format(($enroll->package->price + $enroll->car->price), 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <h3>Instructors</h3>
        <div class="col-md-7">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $instructor->name }}</td>
                            <td>
                                <form action="/admin/enroll/{{ $enroll->id }}/{{ $instructor->id }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-primary">Select</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection