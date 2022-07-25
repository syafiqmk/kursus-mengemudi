@extends('layouts.admin')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-center mb-4">
        <img src="{{ asset('/storage/'.$car->image) }}" width="40%" class="img-fluid">
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Registration Number</td>
                    <td>:</td>
                    <td>{{ $car->registration_number }}</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td>{{ $car->brand->name }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $car->name }}</td>
                </tr>
                <tr>
                    <td>Engine Capacity</td>
                    <td>:</td>
                    <td>{{ $car->engine_capacity }}</td>
                </tr>
                <tr>
                    <td>Transmission</td>
                    <td>:</td>
                    <td>{{ $car->transmission->name }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                        @if ($car->status == 'ready')
                            <p class="badge fs-6 bg-success">Ready</p>
                        @else
                            <p class="badge fs-6 bg-danger">Not Ready</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>


@endsection