@extends('layouts.student')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <table class="table">
        <tr>
            <td>Package</td>
            <td>:</td>
            <td>{{ $enroll->package->name }}</td>
        </tr>
        <tr>
            <td>Car</td>
            <td>:</td>
            <td>{{ $enroll->car->brand->name }} {{ $enroll->car->name }} {{ $enroll->car->transmission->name }} {{ $enroll->car->engine_capacity }} CC ({{ $enroll->car->registration_number }})</td>
        </tr>
        <form action="/student/enroll/pay/process/{{ $enroll->id }}" method="post" enctype="multipart/form-data">
            @csrf

            <tr>
                <td>Payment Image</td>
                <td></td>
                <td>
                    <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" required>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </td>
            </tr>
        </form>
    </table>
@endsection