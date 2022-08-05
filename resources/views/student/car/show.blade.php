@extends('layouts.dashboard')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-7 mb-4">
            <img src="{{ asset('storage/'.$car->image) }}" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Registration Number</td>
                    <td>:</td>
                    <td>{{ $car->registration_number }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $car->name }}</td>
                </tr>
                <tr>
                    <td>Engine Capacity</td>
                    <td>:</td>
                    <td>{{ $car->engine_capacity }} CC</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td>{{ $car->brand->name }}</td>
                </tr>
                <tr>
                    <td>Transmission</td>
                    <td>:</td>
                    <td>{{ $car->transmission->name }}</td>
                </tr>

            </table>
            <form action="{{ route('student.car.destroy', $car->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="btn-group mb-3">
                    <a href="{{ route('student.car.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection