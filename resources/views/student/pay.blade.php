@extends('layouts.dashboard')

@section('content')
    <table class="table">
        <tr>
            <td>Package</td>
            <td>:</td>
            <td>{{ $course->package->name }}</td>
        </tr>
        <tr>
            <td>Car</td>
            <td>:</td>
            <td>{{ $course->car->brand->name }} {{ $course->car->name }} {{ $course->car->transmission->name }} {{ $course->car->engine_capacity }} CC ({{ $course->car->registration_number }})</td>
        </tr>
        <tr>
            <td>Package Price</td>
            <td>:</td>
            <td>Rp. {{ number_format($course->package->price, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Car Rent Price</td>
            <td>:</td>
            <td>Rp. {{ number_format($course->car->price, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp. {{ number_format(($course->package->price + $course->car->price), 2, ',', '.') }}</td>
        </tr>
        <form action="{{ route('student.payProcess', $course->id) }}" method="post" enctype="multipart/form-data">
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