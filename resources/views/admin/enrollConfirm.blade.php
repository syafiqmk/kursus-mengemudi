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
                    <td>{{ $enroll->user->name }}</td>
                </tr>
                <tr>
                    <td>Package</td>
                    <td>:</td>
                    <td>{{ $enroll->package->name }}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>:</td>
                    <td>Rp. {{ $enroll->package->price }}</td>
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